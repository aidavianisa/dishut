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
}
