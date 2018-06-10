<?php

namespace App\Http\Controllers;

use App\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::all();
        return view('kabupaten/table', ['kabupatens' => $kabupatens]);
        // return view('kabupaten/table');
    }

    public function create()
    {
        return view('kabupaten/create');
    }

    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'kabupaten' => 'required',
        ]);

        //insert biasa
        $kabupaten = new Kabupaten;
        $kabupaten->kabupaten = $request->kabupaten;
        $kabupaten->save();
        return redirect('kabupaten');
    }

    public function edit($id)
    {
        $kabupaten = Kabupaten::find($id);
        return view('kabupaten/edit', ['kabupaten' => $kabupaten]);
    }

    public function update(Request $request, $id)
    {
        $kabupaten = Kabupaten::find($id);
        $kabupaten->kabupaten = $request->kabupaten;
        $kabupaten->save();
        return redirect('kabupaten')->with('message','item has been updated successfully');
    }

    public function destroy($id)
    {
        $kabupaten = Kabupaten::find($id);
        $kabupaten->delete();
        return redirect('kabupaten');
    }
}
