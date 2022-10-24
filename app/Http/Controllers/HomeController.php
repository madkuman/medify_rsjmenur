<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\Models\Hospital\UserGroup;
use App\Models\Hospital\Grup;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->inacbg();
        if(is_null(Auth::user()->profesi)) return redirect('getting-started');

        if(Auth::user()->profesi == 20) $role = 'admisi';
        elseif(Auth::user()->profesi == 21) $role = 'manajemen';
        else $role = 'dokter';
        
        $data = $this->dokter();
        $data['kuisioner'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisionerHome();
        return view('home.dokter', $data);

        /*
        if($role == 'dokter')
        {
            return view('home.dokter', $data);

        }
        elseif($role == 'admisi')
        {
            $data = $this->admisi();
            return view('home.admisi', $data);
        }
        elseif($role == 'manajemen')
        {
            return view('home.admisi');
        }
        */
    }

    private function dokter()
    {
        $id = Auth::user()->id;
       
        $month_now = Carbon::now()->startOfMonth();
        $end = Carbon::now();
        $data['kasus'] = [];


        $grup = UserGroup::with(['grup'])->where('users_id', $id)
                            ->whereHas('grup')
                            ->get();
        $data['grup'] = $grup;

        $data['official_group'] = Grup::all();

        $data['undangan_kasus'] = Kolaborator::with(['kasus', 'kasus.pasien', 'kasus.identitas', 'creator', 'user'])->where('user_id',$id)->where('invitation',0)->get();
        $data['undangan_grup'] = UserGroup::with(['grup'])->where('users_id',$id)
                                            ->where('invitation',0)
                                            ->whereColumn('users_id', '!=', 'created_by')
                                            ->whereHas('grup')
                                            ->get();

        return $data;
    }

    public function getSingleUndanganKasus($id)
    {
        $kolab= Kolaborator::with(['user','kasus','kasus.pasien','kasus.lokasi.lokasi','kasus.lokasi.lokasi.departemen','creator'])->where('id',$id)->first();

        if($kolab->kasus->pasien->gender == 1) $jk = 'Laki laki'; 
        else $jk = 'Perempuan';

        $creator_name = $kolab->creator->name;
        $modul_name = $kolab->kasus->lokasi->lokasi->departemen->nama;
        $data = array(
            'id' => $kolab->id,
            'img' => $kolab->kasus->pasien->photo_thumb,
            'nama' => $kolab->kasus->pasien->name,
            'jenis_kelamin' => $jk,
            'judul_kasus' => $kolab->kasus->judul_kasus,
            'age' => $kolab->kasus->pasien->age,
            'layanan' => $modul_name,
            'lokasi' => $kolab->kasus->lokasi->lokasi->nama,
            'creator_name' => $creator_name,
            'message' => $kolab->message,
            'creator_date' => $kolab->created_at->diffForHumans()
        );

        return json_encode($data);
    }

    public function getSingleUndanganGrup($id)
    {
        $invitation= UserGroup::with(['grup','creator'])->where('id',$id)->first();

        $data = array(
            'id' => $invitation->id,
            'slug' => $invitation->grup->slug,
            'nama' => $invitation->grup->name,
            'creator_name' => $invitation->creator->name,
            'creator_date' => $invitation->created_at->diffForHumans()
        );

        return json_encode($data);
    }
    
    // private function admisi()
    // {
    //     $id = Auth::user()->id;
    //     $grup = UserGroup::where('users_id', $id)->get();
    //     $data['grup'] = $grup;
    //     return $data;
    // }

    public function getRequestLog(Request $req)
    {
        if(Auth::user()->id != 10)  abort(404);
        try {
           $date = $req->date;
           $file = storage_path('logs' . DIRECTORY_SEPARATOR . 'timelogger_'.$date.'.log');
            $headers = [
              'Content-Type' => 'application/text',
           ];

            return response()->download($file, 'timelog_'.$date.'.log', $headers);

        } catch (\Exception $e) {
            abort(500);
        }
    }

    private function inacbg()
    {
        $client = new \GuzzleHttp\Client();
        $cookieJar = new \GuzzleHttp\Cookie\CookieJar();

        $response = $client->get('http://belajarkoding-inacbg.com/E-Klaim/login.php?&rndx=b52dc35809eba92e109c5641c34de99b&login=coba&hash=1&rnd=d41d8cd98f00b204e9800998ecf8427e',
                [
                'cookies' => $cookieJar
                ]
            );
        $temp = $cookieJar;
        $temp = $temp->toArray();
        $xml = $response;

        
        /*
        $response = $client->request(
            'POST', 'http://belajarkoding-inacbg.com/E-Klaim/ajaxreq.php',
            [
                'form_params' => [
                    'ac' => 'pajx',
                    'ff' => 'app_searchPatient',
                    'ffargs[0]' => '123'
                ],
                'cookies' => $cookieJar
            ]
        );

        $content = $response->getBody()->getContents();
        echo $content;
        */
        
        $response = $client->request(
            'POST', 'http://belajarkoding-inacbg.com/E-Klaim/ajaxreq.php',
            [
                'form_params' => [
                    'ac' => 'pnlejx',
                    'ff' => 'app_searchICD9Proc',
                    'ffargs[0]' => '81.54'
                ],
                'cookies' => $cookieJar
            ]
        );

        $content = $response->getBody()->getContents();
        echo $content;

        /*
        $response = $client->get('http://belajarkoding-inacbg.com/E-Klaim/index.php?XP_klaim',
            [
                'cookies' => $cookieJar
            ]
        );

        $content = $response->getBody()->getContents();
        echo $content;
        */
        dd('stop',$cookieJar,$temp);

    }

    public function testing(){
        return "testing";
    }
}