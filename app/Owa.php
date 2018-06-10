<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owa extends Model
{
    protected $table = 'data_owa';
    protected $primaryKey = 'id';
    protected $fillable = ['lokasiowa_id','tanggal','pengunjung','jumlah_penerimaan'];
    public $timestamps = false; //created_at updated_ad ngga ada

    public function lokasi()
    {
    	return $this->belongsTo('App\LokasiOwa','lokasiowa_id');
    }
}
