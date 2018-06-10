<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiOwa extends Model
{
	protected $table = 'lokasi_owas';
	protected $primaryKey = 'id';
    protected $fillable = ['lokasi_owa', 'latitude', 'longitude'];
    public $timestamps = false;

    public function owas()
    {
    	return $this->hasMany('App\Owa');
    }
}
