<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';
	protected $primaryKey = 'id';
    protected $fillable = ['kabupaten'];
    public $timestamps = false;

    public function luas_hutan()
    {
    	return $this->hasMany('App\LuasHutan');
    }

    public function wisata()
    {
    	return $this->hasMany('App\Wisata');
    }

    public function potensi_wisata()
    {
        return $this->hasMany('App\PotensiWisata');
    }

    //  

    // public function hutan_lindung()
    // {
    //     return $this->hasMany('App\HutanLindung');
    // }

    // public function cagar_alam()
    // {
    //     return $this->hasMany('App\CagarAlam');
    // }

    // public function suaka_margasatwa()
    // {
    //     return $this->hasMany('App\SuakaMargasatwa');
    // }

    // public function taman_wisata_alam()
    // {
    //     return $this->hasMany('App\TamanWisataAlam');
    // }

    // public function taman_nasional()
    // {
    //     return $this->hasMany('App\TamanNasional');
    // }

    // public function taman_hutan_raya()
    // {
    //     return $this->hasMany('App\TamanHutanRaya');
    // }
}
