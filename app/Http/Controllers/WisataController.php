<?php

namespace App\Http\Controllers;

use App\Wisata;
use App\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Mapper;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::with('kabupaten')->orderBy('id', 'desc')->paginate(15);
        return view('wisata/table', ['wisata' => $wisata]);
    }

    public function map()
    {
        $wisata = Wisata::all();
        Mapper::map(-7.5360639, 112.2384017,['marker' => false,  'type' => 'HYBRID']);
        
        foreach ($wisata as $key) {
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
        return view('wisata/map');
    }

    public function create()
    {
        $kabupaten = Kabupaten::all();
        return view('wisata/create', ['kabupaten' => $kabupaten]);
    }

    public function store(Request $request)
    {
        $wisata = new Wisata;
        $wisata->wisata = $request->wisata;
        $wisata->kabupaten_id = $request->kabupaten_id;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->keterangan = $request->keterangan;
        $wisata->save();
        return redirect('wisata');
    }

    public function edit($id)
    {
        $wisata = Wisata::find($id);
        $kabupaten = Kabupaten::all();
        return view('wisata/edit', ['wisata' => $wisata, 'kabupaten' => $kabupaten]);
    }

    public function update(Request $request, $id)
    {
        $wisata = Wisata::find($id);
        $wisata->wisata = $request->wisata;
        $wisata->kabupaten_id = $request->kabupaten_id;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->keterangan = $request->keterangan;
        $wisata->save();
        return redirect('wisata')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $wisata = Wisata::find($id);
        $wisata->delete();
        return redirect('wisata');
    }
}
