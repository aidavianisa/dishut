<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owalokasi extends Model
{
	protected $table = 'lokasi_owas';
    public $timestamps = false; //created_at updated_ad ngga ada

    //protected $fillable = ['lokasi_owa'];//whitelist
    //protected $guarded = ['created_at'];//blacklist
} 
