<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NambahKabupatenDiPotensiWisata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('potensi_wisata', function (Blueprint $table) {
            $table->integer('kabupaten_id')->nullable()->after('wisata')->unsigned;
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('potensi_wisata', function (Blueprint $table) {
            //
        });
    }
}
