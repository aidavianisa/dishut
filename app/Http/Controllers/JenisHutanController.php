<?php

namespace App\Http\Controllers;

use App\JenisHutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHutanController extends Controller
{
    public function index()
    {
        $jenis_hutans = JenisHutan::all();
        return view('jenis_hutan/table', ['jenis_hutans' => $jenis_hutans]);
        //return view('lokasi_owa/table', ['lokasi_owas' => $lokasi_owas]);
    }

    public function create()
    {
        return view('jenis_hutan/create');
    }

    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'jenis_hutan' => 'required',
        ]);

        //insert biasa
        $jenis_hutan = new JenisHutan;
        $jenis_hutan->jenis_hutan = $request->jenis_hutan;
        $jenis_hutan->save();
        return redirect('jenis_hutan');
    }

    public function edit($id)
    {
        $jenis_hutan = JenisHutan::find($id);
        return view('jenis_hutan/edit', ['jenis_hutan' => $jenis_hutan]);
    }

    public function update(Request $request, $id)
    {
        $jenis_hutan = JenisHutan::find($id);
        $jenis_hutan->jenis_hutan = $request->jenis_hutan;
        $jenis_hutan->save();
        return redirect('jenis_hutan')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $jenis_hutan = JenisHutan::find($id);
        $jenis_hutan->delete();
        return redirect('jenis_hutan');
    }
}
