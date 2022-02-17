<?php

namespace App\Http\Controllers\Template;
class TerbilangIndo{
function kata($x) {
    $x = abs($x);
    $angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
    "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->kata($x - 10). " Belas";
    } else if ($x <100) {
        $temp = $this->kata($x/10)." Puluh". $this->kata($x % 10);
    } else if ($x <200) {
        $temp = " Seratus" . $this->kata($x - 100);
    } else if ($x <1000) {
        $temp = $this->kata($x/100) . " Ratus" . $this->kata($x % 100);
    } else if ($x <2000) {
        $temp = " Seribu" . $this->kata($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->kata($x/1000) . " Ribu" . $this->kata($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->kata($x/1000000) . " Juta" . $this->kata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->kata($x/1000000000) . " Milyar" . $this->kata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->kata($x/1000000000000) . " Trilyun" . $this->kata(fmod($x,1000000000000));
    }     
        return $temp;
}

function terbilang($x, $style=3) {
    if($x<0) {
        $hasil = "minus ". trim($this->kata($x));
    } else {
        $hasil = trim($this->kata($x));
    }     
    switch ($style) {
        case 1:
            // mengubah semua karakter menjadi huruf besar
            $hasil = strtoupper($hasil);
            break;
        case 2:
            // mengubah karakter pertama dari setiap $this->kata menjadi huruf besar
            $hasil = ucwords($hasil);
            break;
        case 3:
            // mengubah karakter pertama menjadi huruf besar
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}
}