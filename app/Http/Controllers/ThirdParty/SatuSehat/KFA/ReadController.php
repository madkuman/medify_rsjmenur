<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\KFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ReadController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('q');

        $client = new Client();
        $headers = app(\App\Http\Controllers\ThirdParty\SatuSehat\RequestController::class)->getHeader();
        $response = $client->get(
            'https://api-satusehat.kemkes.go.id//kfa-v2/products/all',
            [
                'headers' => $headers,
                'query' => [
                    'page' => 1, // Sesuaikan dengan kebutuhan, misalnya bisa dynamic
                    'size' => 100,
                    'product_type' => 'farmasi',
                    'keyword' => $keyword
                ]
            ]
        );
        $products = json_decode($response->getBody()->getContents(), true);
        return response()->json($products);
    }

    public function getProductDetail($keyword)
    {
        // dd('s');
        $client = new Client();
        $headers = app(\App\Http\Controllers\ThirdParty\SatuSehat\RequestController::class)->getHeader();
        $response = $client->get("https://api-satusehat.kemkes.go.id//kfa-v2/products?identifier=kfa&code=$keyword", [
            'headers' => $headers,
            'query' => [
                'identifier' => 'kfa',
                'code' => $keyword,
            ]
        ]);

        $productDetail = json_decode($response->getBody()->getContents(), true);
        // $productDetail = json_encode($productDetail);
        // return response()->json($productDetail);
        return (json_encode($productDetail));
    }
}
