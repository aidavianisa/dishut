<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NambahKabupatenDiWisata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wana_wisata', function (Blueprint $table) {
            $table->integer('kabupaten_id')->nullable()->after('wisata')->unsigned();
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
        Schema::table('wana_wisata', function (Blueprint $table) {
            //
        });
    }
}
