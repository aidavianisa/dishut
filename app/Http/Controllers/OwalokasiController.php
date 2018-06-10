<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Owalokasi;

class OwalokasiController extends Controller
{
    public function index()
    {
    	$owalokasis = Owalokasi::all();
    	return view('owa_lokasi/table', ['owalokasis' => $owalokasis]);
    }

    public function show($id)
    {
    	//$nilai = 'ini adalah linknya'. $id;
    	//$user = 'hilman ramadhan';
    	//$users = ['aida', 'via', 'nisa'];
    	//users = DB::table('lokasi_owas')->where('username','like','%a%')->get();

    	//insert
    	//DB::table('lokasi_owas')->insert([
    		//['lokasi_owa' => 'lokasi owa baru']
    	//]);

    	//update
    	//DB::table('lokasi_owas')->where('lokasi_owa','baru')->update([ 'lokasi_owa' => 'lokasibagus' ]);

    	//delete
    	//DB::table('lokasi_owas')->where('id', '=', 10)->delete();

    	//$users = DB::table('lokasi_owas')->get();

    	$owalokasi = Owalokasi::find($id);
    	//$owalokasi = Owalokasi::findOrFail($id);
    	//dd($owalokasi);
    	return view('owa_lokasi/single', ['owalokasi' => $owalokasi]);
    }

    public function create()
    {
    	return view('owa_lokasi/create');
    }

    public function store(Request $request)
    {
    	//validasi
    	$this->validate($request, [
    		'lokasi_owa' => 'required',
    	]);

    	//insert biasa
    	$owalokasi = new Owalokasi;
    	$owalokasi->lokasi_owa = $request->lokasi_owa;
    	$owalokasi->save();
    	return redirect('owa_lokasi');

    	//insert mass assignmer
    	//Owalokasi::create([
    	// 	'lokasi_owa' => 'lokasi paling bagus',
    	// ]);
    }

    public function edit($id)
    {
    	$owalokasi = Owalokasi::find($id);
    	return view('owa_lokasi/edit', ['owalokasi' => $owalokasi]);
    }

    public function update(Request $request, $id)
    {
    	//dd($request);
    	//dd($id);

    	//update biasa
    	$owalokasi = Owalokasi::find($id);
    	$owalokasi->lokasi_owa = $request->lokasi_owa;
    	$owalokasi->save();
    	return redirect('owa_lokasi');
    	//return redirect()->action('OwalokasiController@index');

    	//update mass assignment
    	// Owalokasi::find(18)->update([
    	// 	'lokasi_owa' => 'lokasitook',
    	// ]);
    }

    public function destroy($id)
    {
    	//delete
    	$owalokasi = Owalokasi::find($id);
    	$owalokasi->delete();
    	return redirect('owa_lokasi');

    	//delete kedua
    	// Owalokasi::destroy([15,16]);

    	//soft deletes dan return (deleted_at) ada di video belajar koding 8
    	// $owalokasi = Owalokasi::find(14);
    	// $owalokasi->delete();
    }
}
