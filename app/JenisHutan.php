<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisHutan extends Model
{
    protected $table = 'jenis_hutan';
	protected $primaryKey = 'id';
    protected $fillable = ['jenis_hutan'];
    public $timestamps = false;

    public function luas_hutan()
    {
    	return $this->hasMany('App\LuasHutan');
    }

    // public function hutan_produksi()
    // {
    // 	return $this->hasMany('App\HutanProduksi');
    // }

    // public function hutan_lindung()
    // {
    // 	return $this->hasMany('App\HutanLindung');
    // }

    // public function cagar_alam()
    // {
    // 	return $this->hasMany('App\CagarAlam');
    // }

    // public function suaka_margasatwa()
    // {
    // 	return $this->hasMany('App\SuakaMargasatwa');
    // }

    // public function taman_wisata_alam()
    // {
    // 	return $this->hasMany('App\TamanWisataAlam');
    // }

    // public function taman_nasional()
    // {
    // 	return $this->hasMany('App\TamanNasional');
    // }

    // public function taman_hutan_raya()
    // {
    // 	return $this->hasMany('App\TamanHutanRaya');
    // }
}
