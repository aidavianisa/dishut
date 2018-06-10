<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wana_wisata';
    protected $primaryKey = 'id';
    protected $fillable = ['wisata','kabupaten_id', 'latitude', 'longitude'];
    public $timestamps = false; //created_at updated_ad ngga ada

    public function kabupaten()
    {
    	return $this->belongsTo('App\Kabupaten','kabupaten_id');
    }
}
