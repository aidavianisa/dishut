<?php

namespace App\Http\Controllers;

use App\LuasHutan;
use App\JenisHutan;
use App\Kabupaten;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TamanHutanRayaController extends Controller
{
    public function index(Request $request)
    {
        $luas_hutans = LuasHutan::with('jenis_hutan')->where('jenis_hutan_id', 7)->orderBy('id', 'desc')->paginate(15);
        return view('taman_hutan_raya/table', ['luas_hutans' => $luas_hutans]);
    }

    public function create()
    {
        $jenis_hutans = JenisHutan::all();
        $kabupatens = Kabupaten::all();
        return view('taman_hutan_raya/create', ['jenis_hutans' => $jenis_hutans, 'kabupatens' => $kabupatens]);
    }

    public function store(Request $request)
    {
        //insert biasa
        $luas_hutan = new LuasHutan;
        $luas_hutan->jenis_hutan_id = 7;
        $luas_hutan->kabupaten_id = $request->kabupaten_id;
        $luas_hutan->tanggal = $request->tanggal;
        $luas_hutan->luas = $request->luas;
        $luas_hutan->save();
        return redirect('taman_hutan_raya');
    }

    public function edit($id)
    {
        $luas_hutans = LuasHutan::find($id);
        $jenis_hutans = JenisHutan::all();
        $kabupatens = Kabupaten::all();
        return view('taman_hutan_raya/edit', ['luas_hutans' => $luas_hutans, 'jenis_hutans' => $jenis_hutans, 'kabupatens' => $kabupatens]);
    }

    public function update(Request $request, $id)
    {
        $luas_hutan = LuasHutan::find($id);
        $luas_hutan->jenis_hutan_id = 7;
        $luas_hutan->kabupaten_id = $request->kabupaten_id;
        $luas_hutan->tanggal = $request->tanggal;
        $luas_hutan->luas = $request->luas;
        $luas_hutan->save();
        return redirect('taman_hutan_raya')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $luas_hutans = LuasHutan::find($id);
        $luas_hutans->delete();
        return redirect('taman_hutan_raya');
    }

    public function excel()
    {
        $luas_hutans = LuasHutan::with('jenis_hutan')->where('jenis_hutan_id', 7)->orderBy('tanggal', 'desc')->get();
        $luas_array[] = array('Kabupaten', 'Tahun', 'Luas');
        foreach ($luas_hutans as $key) {
            $luas_array[] = array(
                'Kabupaten' => $key->kabupaten->kabupaten,
                'Tahun' => $key->tanggal,
                'Luas' => $key->luas,
            );
        }
        Excel::create('Taman Hutan Raya', function($excel) use($luas_array){
            $excel->setTitle('Taman Hutan Raya');
            $excel->sheet('Taman Hutan Raya', function($sheet) use ($luas_array){
                $sheet->fromArray($luas_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
}
