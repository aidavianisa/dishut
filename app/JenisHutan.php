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
}
