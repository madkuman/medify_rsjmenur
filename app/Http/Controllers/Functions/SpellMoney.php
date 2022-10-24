<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpellMoney extends Controller
{
	public function spellMoney($num ,$dec=4)
	{
		$stext = array(
			"Nol",
			"Satu",
			"Dua",
			"Tiga",
			"Empat",
			"Lima",
			"Enam",
			"Tujuh",
			"Delapan",
			"Sembilan",
			"Sepuluh",
			"Sebelas"
		);
		$say  = array(
			"Ribu",
			"Juta",
			"Milyar",
			"Triliun",
			"Biliun"
		);
		$w = "";

		if ($num <0 ) {
			$w  = "Minus ";
			$num *= -1;
		}

		$snum = number_format($num,$dec,",",".");
		$strnum =  explode(".",substr($snum,0,strrpos($snum,",")));
		$koma = substr($snum,strrpos($snum,",")+1);

		$isone = substr($num,0,1)  ==1;
		if (count($strnum)==1) {
			$num = $strnum[0];
			switch (strlen($num)) {
				case 1:
				case 2:
				if (!isset($stext[$strnum[0]])){
					if($num<=19){
						$w .=$stext[substr($num,1)]." Belas";
					}else{
						$w .= $stext[substr($num,0,1)]." Puluh ".
						(intval(substr($num,1))==0 ? "" : $stext[substr($num,1)]);
					}
				}else{
					$w .= $stext[$strnum[0]];
				}
				break;
				case 3:
				$w .=  ($isone ? "Seratus" : $this->spellMoney(substr($num,0,1)) .
					" Ratus").
				" ".(intval(substr($num,1))==0 ? "" : $this->spellMoney(substr($num,1)));
				break;
				case 4:
				$w .=  ($isone ? "Seribu" : $this->spellMoney(substr($num,0,1)) .
					" Ribu").
				" ".(intval(substr($num,1))==0 ? "" : $this->spellMoney(substr($num,1)));
				break;
				default:
				break;
			}
		}else{
			$text = $say[count($strnum)-2];
			$w = ($isone && strlen($strnum[0])==1 && count($strnum) <=2? "Se".strtolower($text) : $this->spellMoney($strnum[0]).' '.$text);
			array_shift($strnum);
			$i =count($strnum)-2;
			foreach ($strnum as $k=>$v) {
				if (intval($v)) {
					$w.= ' '.$this->spellMoney($v).' '.($i >=0 ? $say[$i] : "");
				}
				$i--;
			}
		}
		$w = trim($w);
		if ($dec = intval($koma)) {
			$w .= " Koma ". $this->spellMoney($koma);
		}


		return trim($w);
	}
}
