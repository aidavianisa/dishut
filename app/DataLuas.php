<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLuas extends Model
{
    protected $table = 'data_luas';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_data_id', 'lokasiowa_id','tahun','luas'];
    public $timestamps = false; //created_at updated_ad ngga ada

    public function lokasi()
    {
    	return $this->belongsTo('App\LokasiOwa','lokasiowa_id');
    }

    public function jenis_data()
    {
    	return $this->belongsTo('App\JenisDataLuas','jenis_data_id');
    }
}
