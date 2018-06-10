<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuasHutan extends Model
{
    protected $table = 'luas_hutan';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_hutan_id','kabupaten_id','tanggal','luas'];
    public $timestamps = false; //created_at updated_ad ngga ada

    public function jenis_hutan()
    {
    	return $this->belongsTo('App\JenisHutan','jenis_hutan_id');
    }

    public function kabupaten()
    {
    	return $this->belongsTo('App\Kabupaten','kabupaten_id');
    }
}
