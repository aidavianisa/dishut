<?php

namespace App\Http\Controllers;

use App\DataLuas;
use App\JenisDataLuas;
use App\LokasiOwa;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;

class DataLuasController extends Controller
{

    //LAHAN KRITIS
    public function index(Request $request)
    {
    	$data_luas = DataLuas::select('*')->where('jenis_data_id', 1)->orderBy('tahun', 'desc')->paginate(20);
        $nama_data = 'Lahan Kritis';
    	return view('data_luas/table', ['data_luas' => $data_luas, 'nama_data' => $nama_data]);
    }

    public function create(Request $request)
    {
        $lokasi_owas = LokasiOwa::all();
        $nama_data = 'Lahan Kritis';
        return view('data_luas/create', ['lokasi_owas' => $lokasi_owas, 'nama_data' => $nama_data]);
    }

    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'lokasiowa_id' => 'required',
        ]);
        //insert biasa
        $data_luas = new DataLuas;
        $data_luas->jenis_data_id = 1;
        $data_luas->lokasiowa_id = $request->lokasiowa_id;
        $data_luas->tahun = $request->tahun;
        $data_luas->luas = $request->luas;
        $data_luas->save();
        //return redirect()->route('data_luas', $data);
        return redirect()->action('DataLuasController@index');
    }

    public function edit($id)
    {
        $data_luas = DataLuas::find($id);
        $lokasi_owas = LokasiOwa::all();
        return view('data_luas/edit', ['data_luas' => $data_luas, 'lokasi_owas' => $lokasi_owas]);
    }

    public function update(Request $request, $id)
    {
        $data_luas = DataLuas::find($id);
        $data_luas->jenis_data_id = 1;
        $data_luas->lokasiowa_id = $request->lokasiowa_id;
        $data_luas->tahun = $request->tahun;
        $data_luas->luas = $request->luas;
        $data_luas->save();
        return redirect('data_luas')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $data_luas = DataLuas::find($id);
        $data_luas->delete();
        return redirect('data_luas');
    }

    public function excel()
    {
        $data_luas = DataLuas::select('*')->where('jenis_data_id', 1)->orderBy('tahun', 'desc')->get();
        $array[] = array('Lokasi', 'Tahun', 'Luas');
        foreach ($data_luas as $key) {
            $array[] = array(
                'Lokasi' => $key->lokasi->lokasi_owa,
                'Tahun' => $key->tahun,
                'Luas' => $key->luas,
            );
        }
        Excel::create('Data Luas Lahan Kritis', function($excel) use($array){
            $excel->setTitle('Data Luas Lahan Kritis');
            $excel->sheet('Data Luas Lahan Kritis', function($sheet) use ($array){
                $sheet->fromArray($array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    //KEBAKARAN
    public function kebakaran(Request $request)
    {
        $data_luas = DataLuas::select('*')->where('jenis_data_id', 2)->orderBy('tahun', 'desc')->paginate(20);
        $nama_data = 'Kebakaran';
        return view('data_luas/table_kebakaran', ['data_luas' => $data_luas, 'nama_data' => $nama_data]);
    }

    public function create_kebakaran(Request $request)
    {
        $lokasi_owas = LokasiOwa::all();
        $nama_data = 'Kebakaran';
        return view('data_luas/create_kebakaran', ['lokasi_owas' => $lokasi_owas, 'nama_data' => $nama_data]);
    }

    public function store_kebakaran(Request $request)
    {
        //validasi
        $this->validate($request, [
            'lokasiowa_id' => 'required',
        ]);
        //insert biasa
        $data_luas = new DataLuas;
        $data_luas->jenis_data_id = 2;
        $data_luas->lokasiowa_id = $request->lokasiowa_id;
        $data_luas->tahun = $request->tahun;
        $data_luas->luas = $request->luas;
        $data_luas->save();
        //return redirect()->route('data_luas', $data);
        return redirect()->action('DataLuasController@kebakaran');
    }

    public function edit_kebakaran($id)
    {
        $data_luas = DataLuas::find($id);
        $lokasi_owas = LokasiOwa::all();
        return view('data_luas/edit_kebakaran', ['data_luas' => $data_luas, 'lokasi_owas' => $lokasi_owas]);
    }

    public function update_kebakaran(Request $request, $id)
    {
        $data_luas = DataLuas::find($id);
        $data_luas->jenis_data_id = 2;
        $data_luas->lokasiowa_id = $request->lokasiowa_id;
        $data_luas->tahun = $request->tahun;
        $data_luas->luas = $request->luas;
        $data_luas->save();
        return redirect()->action('DataLuasController@kebakaran');
    }

    public function destroy_kebakaran($id)
    {
        $data_luas = DataLuas::find($id);
        $data_luas->delete();
        return redirect()->action('DataLuasController@kebakaran');
    }

    public function excel_kebakaran()
    {
        $data_luas = DataLuas::select('*')->where('jenis_data_id', 2)->orderBy('tahun', 'desc')->get();
        $array[] = array('Lokasi', 'Tahun', 'Luas');
        foreach ($data_luas as $key) {
            $array[] = array(
                'Lokasi' => $key->lokasi->lokasi_owa,
                'Tahun' => $key->tahun,
                'Luas' => $key->luas,
            );
        }
        Excel::create('Data Luas Kebakaran', function($excel) use($array){
            $excel->setTitle('Data Luas Kebakaran');
            $excel->sheet('Data Luas Kebakaran', function($sheet) use ($array){
                $sheet->fromArray($array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
}
