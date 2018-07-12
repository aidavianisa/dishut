<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisDataLuas extends Model
{
    protected $table = 'jenis_data_luas';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_data'];
    public $timestamps = false;

    public function data_luas()
    {
    	return $this->hasMany('App\DataLuas');
    }
}
