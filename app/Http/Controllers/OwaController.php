<?php

namespace App\Http\Controllers;

use App\Owa;
use App\LokasiOwa;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;


class OwaController extends Controller
{

    public function index(Request $request)
    {
        if (is_null($tahun = $request->get('years')) && is_null($bulan = $request->get('months')) && is_null($lokasi = $request->get('lokasiowa_id'))) {
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->paginate(15);
        }
        else if (!empty($bulan = $request->get('months')) && is_null($tahun = $request->get('years')) && is_null($lokasi = $request->get('lokasiowa_id'))) {
            $bulan = $request->get('months');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
                ->paginate(15);
        }
        else if (!empty($tahun = $request->get('years')) && is_null($bulan = $request->get('months')) && is_null($lokasi = $request->get('lokasiowa_id'))) {
            $tahun = $request->get('years');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
                ->paginate(15);
        }
        else if (!empty($lokasi = $request->get('lokasiowa_id')) && is_null($bulan = $request->get('months')) && is_null($tahun = $request->get('years'))) {
            $lokasi = $request->get('lokasiowa_id');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where('lokasiowa_id', $lokasi)
                ->paginate(15);
        }
        else if (!empty($bulan = $request->get('months')) && !empty($tahun = $request->get('years')) && is_null($lokasi = $request->get('lokasiowa_id'))) {
            $bulan = $request->get('months');
            $tahun = $request->get('years');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
                ->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
                ->paginate(15);
        }
        else if (!empty($bulan = $request->get('months')) && is_null($tahun = $request->get('years')) && !empty($lokasi = $request->get('lokasiowa_id'))) {
            $bulan = $request->get('months');
            $lokasi = $request->get('lokasiowa_id');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
                ->where('lokasiowa_id', $lokasi)
                ->paginate(15);
        }
        else if (is_null($bulan = $request->get('months')) && !empty($tahun = $request->get('years')) && !empty($lokasi = $request->get('lokasiowa_id'))) {
            $tahun = $request->get('years');
            $lokasi = $request->get('lokasiowa_id');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
                ->where('lokasiowa_id', $lokasi)
                ->paginate(15);
        }
        else{
            $tahun = $request->get('years');
            $bulan = $request->get('months');
            $lokasi = $request->get('lokasiowa_id');
            $owa = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))
                ->orderBy('tanggal', 'desc')
                ->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
                ->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
                ->where('lokasiowa_id', $lokasi)
                ->paginate(15);
        }

        //filter lokasi
        $lokasi_owas = LokasiOwa::all();
        
        return view('owa/table', ['owa' => $owa, 'lokasi_owas' => $lokasi_owas]);
    }

    public function grafik(Request $request)
    {
        if (is_null($tahun = $request->get('years')) ) {
            // date_default_timezone_set("Asia/Jakarta");
            // $tahun = date('Y');
            $tahun = 2014;
        }
        else{
            $tahun = $request->get('years');
        }
        
        $lokasi_owa = LokasiOwa::all();

        //---RAMAL PERTAHUN-----
        //menentukan total pertahun
        $total = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('YEAR(tanggal)'), '=', $tahun)->groupBy(DB::raw("YEAR(tanggal)"))->get();
        $total_lama = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('YEAR(tanggal)'), '=', $tahun-1)->groupBy(DB::raw("YEAR(tanggal)"))->get();

        if ($tahun ==2012) {
            $persen_pengunjungs = 0;
            $persen_penerimaans = 0;
        }
        else{
            foreach ($total as $key) {
                foreach ($total_lama as $key1) {
                    $persen_pengunjungs = ($key->pengunjungs-$key1->pengunjungs)/$key1->pengunjungs*100;
                    $persen_penerimaans = ($key->penerimaans-$key1->penerimaans)/$key1->penerimaans*100;
                }
            }
        }
        //akhir menentukan total pertahun

        //ramal
        for ($i=2012; $i <=$tahun; $i++) { 
            if($i == 2012){
                $data = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('YEAR(tanggal)'), '=', $i)->groupBy(DB::raw("YEAR(tanggal)"))->get();
                foreach ($data as $key) {
                    $ramal_pengunjung = (double)$key->pengunjungs;
                    $ramal_penerimaan = (double)$key->penerimaans;
                    $err_pengunjung = 0;
                    $err_penerimaan = 0;
                }
            }
            else{
                $data = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('YEAR(tanggal)'), '=', $i)->groupBy(DB::raw("YEAR(tanggal)"))->get();
                foreach ($data as $key) {
                    $ramal_pengunjung = (0.9 * (double)$key->pengunjungs) + ((1 - 0.9)* (double)$ramal_pengunjung_lama);
                    $ramal_penerimaan = (0.9 * (double)$key->penerimaans) + ((1 - 0.9)* (double)$ramal_penerimaan_lama);
                    $err_pengunjung = (abs((double)$ramal_pengunjung_lama - (double)$key->pengunjung))/ (double)$key->pengunjungs * 100;
                    $err_penerimaan = (abs((double)$ramal_penerimaan_lama - (double)$key->penerimaans))/ (double)$key->penerimaans * 100;
                }
            }
            $ramal_pengunjung_lama = (double)$ramal_pengunjung;
            $ramal_penerimaan_lama = (double)$ramal_penerimaan;
        }
        //akhir ramal
        //----AKHIR RAMAL PERTAHUN----


        // RAMAL PERBULAN
        for ($i=2012; $i <= $tahun ; $i++) {
            for ($j=1; $j <=12 ; $j++) { 
                $total1 = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('MONTH(tanggal)'), '=', $j)->where(DB::raw('YEAR(tanggal)'), '=', $i)->groupBy(DB::raw("MONTH(tanggal)"))->get();
                $total_lama1 = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('YEAR(tanggal)'), '=', $tahun-1)->groupBy(DB::raw("MONTH(tanggal)"))->get();

                //persen
                if ($tahun ==2012) {
                    $persen_pengunjungs1 = 0;
                    $persen_penerimaans1 = 0;
                }
                else{
                    foreach ($total1 as $key) {
                        foreach ($total_lama1 as $key1) {
                            $persen_pengunjungs1 = ($key->pengunjungs1-$key1->pengunjungs)/$key1->pengunjungs*100;
                            $persen_penerimaans1 = ($key->penerimaans1-$key1->penerimaans)/$key1->penerimaans*100;
                        }
                    }
                }

                //ramal
                if(($i == 2012) && ($j == 1)){
                    $data1 = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('MONTH(tanggal)'), '=', $j)->where(DB::raw('YEAR(tanggal)'), '=', $i)->groupBy(DB::raw("MONTH(tanggal)"))->get();
                    foreach ($data1 as $key) {
                        $ramal_pengunjung1 = (double)$key->pengunjungs;
                        $ramal_penerimaan1 = (double)$key->penerimaans;
                        $err_pengunjung1 = 0;
                        $err_penerimaan1 = 0;
                    }
                }
                else{
                    $data1 = Owa::select(DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans'))->where(DB::raw('MONTH(tanggal)'), '=', $j)->where(DB::raw('YEAR(tanggal)'), '=', $i)->groupBy(DB::raw("MONTH(tanggal)"))->get();
                    foreach ($data1 as $key) {
                        $ramal_pengunjung1 = (0.1 * (double)$key->pengunjungs) + ((1 - 0.1)* (double)$ramal_pengunjung_lama1);
                        $ramal_penerimaan1 = (0.1 * (double)$key->penerimaans) + ((1 - 0.1)* (double)$ramal_penerimaan_lama1);
                        $err_pengunjung1 = (abs((double)$ramal_pengunjung_lama1 - (double)$key->pengunjung))/ (double)$key->pengunjungs * 100;
                        $err_penerimaan1 = (abs((double)$ramal_penerimaan_lama1 - (double)$key->penerimaans))/ (double)$key->penerimaans * 100;
                    }
                }
                $ramal_pengunjung_lama1 = (double)$ramal_pengunjung1;
                $ramal_penerimaan_lama1 = (double)$ramal_penerimaan1;
            }
        }
        //dd($ramal_pengunjung1);
        // AKHIR RAMAL PERBULAN

        foreach ($lokasi_owa as $key) {

            $owas = Owa::select('*',DB::raw('SUM(pengunjung) as pengunjungs, SUM(jumlah_penerimaan) as penerimaans, YEAR(tanggal) as tahun, MONTH(tanggal) as bulan'))
                    ->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
                    ->where('lokasiowa_id', '=', $key->id)
                    ->groupBy(DB::raw("MONTH(tanggal)"))
                    ->join('lokasi_owas', 'lokasi_owas.id', '=', 'data_owa.lokasiowa_id')
                    ->get();

            $list[] = array(
                'lokasi_owas' => $key->lokasi_owa,
                'data_owa' => $owas,
            );
        }
        return view('owa/grafik', ['owas' => $owas,
                                   'data' => $list, 
                                   'now' => $tahun, 
                                   'total' => $total,
                                   'persen_pengunjungs' => $persen_pengunjungs,
                                   'persen_penerimaans' => $persen_penerimaans,
                                   'ramal_pengunjung' => $ramal_pengunjung,
                                   'ramal_penerimaan' => $ramal_penerimaan,
                                   'err_pengunjung' => $err_pengunjung,
                                   'err_penerimaan' => $err_penerimaan,
                                   'total1' => $total1,
                                   'persen_pengunjungs1' => $persen_pengunjungs1,
                                   'persen_penerimaans1' => $persen_penerimaans1,
                                   'ramal_pengunjung1' => $ramal_pengunjung1,
                                   'ramal_penerimaan1' => $ramal_penerimaan1,
                                   'err_pengunjung1' => $err_pengunjung1,
                                   'err_penerimaan1' => $err_penerimaan1]);
    }

    public function create()
    {
        //$owas = Owa::all();
        $lokasi_owas = LokasiOwa::all();
        return view('owa/create', ['lokasi_owas' => $lokasi_owas]);
        //return View::make('owa.create', compact('owas', 'lokasi_owas'));
    }

    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'lokasiowa_id' => 'required',
        ]);

        //insert biasa
        $owa = new Owa;
        $owa->lokasiowa_id = $request->lokasiowa_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tanggal = strtotime($tahun.'-'.$bulan.'-01');
        $owa->tanggal = date('Y-m-d', $tanggal);
        //dd($owa->tanggal);
        //$owa->tanggal = $request->tanggal;
        $owa->pengunjung = $request->pengunjung;
        $owa->jumlah_penerimaan = $request->jumlah_penerimaan;
        $owa->save();
        return redirect('owa');
    }

    public function edit($id)
    {
        $owas = Owa::find($id);
        $lokasi_owas = LokasiOwa::all();
        return view('owa/edit', ['owas' => $owas, 'lokasi_owas' => $lokasi_owas]);
    }

    public function update(Request $request, $id)
    {
        $owa = Owa::find($id);
        $owa->lokasiowa_id = $request->lokasiowa_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tanggal = strtotime($tahun.'-'.$bulan.'-01');
        $owa->tanggal = date('Y-m-d', $tanggal);
        $owa->pengunjung = $request->pengunjung;
        $owa->jumlah_penerimaan = $request->jumlah_penerimaan;
        $owa->save();
        return redirect('owa')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $owas = Owa::find($id);
        $owas->delete();
        return redirect('owa');
    }

    public function excel()
    {
        $owas = Owa::select('*',DB::raw('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun'))->orderBy('tanggal', 'desc')->get();
        $owa_array[] = array('Lokasi', 'Bulan', 'Tahun', 'Pengunjung', 'Penerimaan');
        foreach ($owas as $owa) {
            $owa_array[] = array(
                'Lokasi' => $owa->lokasi->lokasi_owa,
                'Bulan' => $owa->bulan,
                'Tahun' => $owa->tahun,
                'Pengunjung' => $owa->pengunjung,
                'Penerimaan' => $owa->jumlah_penerimaan,
            );
        }
        Excel::create('Data Owa', function($excel) use($owa_array){
            $excel->setTitle('Data Owa');
            $excel->sheet('Data Owa', function($sheet) use ($owa_array){
                $sheet->fromArray($owa_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

}
