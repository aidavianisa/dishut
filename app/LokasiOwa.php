<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiOwa extends Model
{
	protected $table = 'lokasi_owas';
	protected $primaryKey = 'id';
    protected $fillable = ['lokasi_owa', 'luas_wilayah', 'latitude', 'longitude'];
    public $timestamps = false;

    public function owas()
    {
    	return $this->hasMany('App\Owa');
    }

    public function data_luas()
    {
    	return $this->hasMany('App\DataLuas');
    }
}
