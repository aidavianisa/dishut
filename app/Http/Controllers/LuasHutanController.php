<?php

namespace App\Http\Controllers;

use App\LuasHutan;
use App\JenisHutan;
use App\Kabupaten;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LuasHutanController extends Controller
{
    public function index()
    {
        $tahun = 2016;
        $jenis_hutan = JenisHutan::all();

        foreach ($jenis_hutan as $key) {
            $data_luas = LuasHutan::select('*', DB::raw('SUM(luas) as luass'))
            ->where('jenis_hutan_id', '=', $key->id)
            ->groupBy(DB::raw("YEAR(tanggal)"))
            ->join('jenis_hutan', 'jenis_hutan.id', '=', 'luas_hutan.jenis_hutan_id')
            ->get();

            $tahun_awal = LuasHutan::min('tanggal');
            $tahun_akhir = LuasHutan::max('tanggal');

            $j = 0;
            for($i = $tahun_awal; $i <= $tahun_akhir; $i++){
                $jarak_tahun[$j] = $i;
                $j++;
            }

            // foreach ($data_luas as $key) {
            //     $tahuns = $key->tanggal;
            // }

            // for($i=0; $i<$j; $i++){
            //     if($tahuns == $tahun_awal){
            //         $data_luas->urut = $i;
            //         break;
            //     }
            //     else{
            //         $tahun_awal++;
            //     }
            // }

            $list[] = array(
                'jenis_hutan' => $key->jenis_hutan,
                'data_luas' => $data_luas,
            );

            // if($tahun_akhir <= $tahun){
            //     $list[] = array(
            //         'jenis_hutan' => $key->jenis_hutan,
            //         'data_luas' => $data_luas,
            //     );
            // }
        }

        // $tahun_awal = LuasHutan::min('tanggal');
        // $tahun_akhir = LuasHutan::max('tanggal');

        // $j = 0;
        // for($i = $tahun_awal; $i <= $tahun_akhir; $i++){
        //     $jarak_tahun[$j] = $i;
        //     $j++;
        // }
        //dd($list);//dapetin total tahun
        $luas_hutans = LuasHutan::with('jenis_hutan')->orderBy('id', 'desc')->paginate(15);
        return view('luas_hutan/table', [
            'luas_hutans' => $luas_hutans,
            'list' => $list,
            'jarak_tahun' => $jarak_tahun,
        ]);
    }

    public function create()
    {
        $jenis_hutans = JenisHutan::all();
        $kabupatens = Kabupaten::all();
        return view('luas_hutan/create', ['jenis_hutans' => $jenis_hutans, 'kabupatens' => $kabupatens]);
    }

    public function store(Request $request)
    {
        //insert biasa
        $luas_hutan = new LuasHutan;
        $luas_hutan->jenis_hutan_id = $request->jenis_hutan_id;
        $luas_hutan->kabupaten_id = $request->kabupaten_id;
        $luas_hutan->tanggal = $request->tanggal;
        $luas_hutan->luas = $request->luas;
        $luas_hutan->save();
        return redirect('luas_hutan');
    }

    public function edit($id)
    {
        $luas_hutans = LuasHutan::find($id);
        $jenis_hutans = JenisHutan::all();
        $kabupatens = Kabupaten::all();
        return view('luas_hutan/edit', ['luas_hutans' => $luas_hutans, 'jenis_hutans' => $jenis_hutans, 'kabupatens' => $kabupatens]);
    }

    public function update(Request $request, $id)
    {
        $luas_hutan = LuasHutan::find($id);
        $luas_hutan->jenis_hutan_id = $request->jenis_hutan_id;
        $luas_hutan->kabupaten_id = $request->kabupaten_id;
        $luas_hutan->tanggal = $request->tanggal;
        $luas_hutan->luas = $request->luas;
        $luas_hutan->save();
        return redirect('luas_hutan')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $luas_hutans = LuasHutan::find($id);
        $luas_hutans->delete();
        return redirect('luas_hutan');
    }

    public function excel()
    {
        $luas_hutans = LuasHutan::with('jenis_hutan')->orderBy('tanggal', 'desc')->get();
        $luas_array[] = array('Hutan', 'Kabupaten', 'Tahun', 'Luas');
        foreach ($luas_hutans as $key) {
            $luas_array[] = array(
                'Hutan' => $key->jenis_hutan->jenis_hutan,
                'Kabupaten' => $key->kabupaten->kabupaten,
                'Tahun' => $key->tanggal,
                'Luas' => $key->luas,
            );
        }
        Excel::create('Luas Hutan', function($excel) use($luas_array){
            $excel->setTitle('Luas Hutan');
            $excel->sheet('Luas Hutan', function($sheet) use ($luas_array){
                $sheet->fromArray($luas_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
}
