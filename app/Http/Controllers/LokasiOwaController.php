<?php

namespace App\Http\Controllers;

use App\LokasiOwa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiOwaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi_owas = LokasiOwa::all();
        return view('lokasi_owa/table', ['lokasi_owas' => $lokasi_owas]);
        //return view('lokasi_owa/table', ['lokasi_owas' => $lokasi_owas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lokasi_owa/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'lokasi_owa' => 'required',
        ]);

        //insert biasa
        $lokasi_owa = new LokasiOwa;
        $lokasi_owa->lokasi_owa = $request->lokasi_owa;
        $lokasi_owa->save();
        return redirect('lokasi_owa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //buat read
    {
        // $lokasi_owa = LokasiOwa::find($id);
        // return view('lokasi_owa/single', ['lokasi_owa' => $lokasi_owa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lokasi_owa = LokasiOwa::find($id);
        return view('lokasi_owa/edit', ['lokasi_owa' => $lokasi_owa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lokasi_owa = LokasiOwa::find($id);
        $lokasi_owa->lokasi_owa = $request->lokasi_owa;
        $lokasi_owa->save();
        return redirect('lokasi_owa')->with('message','item has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lokasi_owa = LokasiOwa::find($id);
        $lokasi_owa->delete();
        return redirect('lokasi_owa');
    }
}
