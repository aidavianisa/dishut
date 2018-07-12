<?php

namespace App\Http\Controllers;

use App\PotensiWisata;
use App\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Mapper;

class PotensiWisataController extends Controller
{
    public function index()
    {
        $potensi_wisata = PotensiWisata::with('kabupaten')->orderBy('id', 'desc')->paginate(15);
        return view('potensi_wisata/table', ['potensi_wisata' => $potensi_wisata]);
    }

    public function map()
    {
        $potensi_wisata = PotensiWisata::all();
        Mapper::map(-7.5360639, 112.2384017,['marker' => false,  'type' => 'HYBRID']);
        
        foreach ($potensi_wisata as $key) {
            if(is_null($key->latitude)){
                continue;
            }
            else{
                Mapper::informationWindow(
                    $key->latitude, 
                    $key->longitude, 
                    $key->wisata, 
                    ['title' => $key->wisata,'animation' => 'DROP']
                );
            }
        }
        return view('potensi_wisata/map');
    }

    public function create()
    {
        $kabupaten = Kabupaten::all();
        return view('potensi_wisata/create', ['kabupaten' => $kabupaten]);
    }

    public function store(Request $request)
    {
        $potensi_wisata = new PotensiWisata;
        $potensi_wisata->wisata = $request->wisata;
        $potensi_wisata->kabupaten_id = $request->kabupaten_id;
        $potensi_wisata->latitude = $request->latitude;
        $potensi_wisata->longitude = $request->longitude;
        $potensi_wisata->keterangan = $request->keterangan;
        $potensi_wisata->save();
        return redirect('potensi_wisata');
    }

    public function lihat($id)
    {
        $potensi_wisata = PotensiWisata::find($id);
        $kabupaten = Kabupaten::all();
        return view('potensi_wisata/lihat', ['potensi_wisata' => $potensi_wisata, 'kabupaten' => $kabupaten]);
    }

    public function edit($id)
    {
        $potensi_wisata = PotensiWisata::find($id);
        $kabupaten = Kabupaten::all();
        return view('potensi_wisata/edit', ['potensi_wisata' => $potensi_wisata, 'kabupaten' => $kabupaten]);
    }

    public function update(Request $request, $id)
    {
        $potensi_wisata = PotensiWisata::find($id);
        $potensi_wisata->wisata = $request->wisata;
        $potensi_wisata->kabupaten_id = $request->kabupaten_id;
        if (!empty($request->latitude)) {
        	$potensi_wisata->latitude = $request->latitude;
        }
        if (!empty($request->longitude)) {
        	$potensi_wisata->longitude = $request->longitude;
        }
        $potensi_wisata->keterangan = $request->keterangan;
        $potensi_wisata->save();
        return redirect('potensi_wisata')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $potensi_wisata = PotensiWisata::find($id);
        $potensi_wisata->delete();
        return redirect('potensi_wisata');
    }
}
