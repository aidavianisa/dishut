<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotensiWisata extends Model
{
    protected $table = 'potensi_wisata';
    protected $primaryKey = 'id';
    protected $fillable = ['wisata','kabupaten_id', 'latitude', 'longitude', 'keterangan'];
    public $timestamps = false; //created_at updated_ad ngga ada

    public function kabupaten()
    {
    	return $this->belongsTo('App\Kabupaten','kabupaten_id');
    }
}
