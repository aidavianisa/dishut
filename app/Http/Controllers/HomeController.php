<?php

namespace App\Http\Controllers;

use App\LokasiOwa;
use App\Owa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Mapper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi_owa = LokasiOwa::all();

        foreach ($lokasi_owa as $key) {

            $owas = Owa::select('*',DB::raw('SUM(jumlah_penerimaan) as penerimaans, SUM(pengunjung) as pengunjungs'))
                    ->where('lokasiowa_id', '=', $key->id)
                    ->join('lokasi_owas', 'lokasi_owas.id', '=', 'data_owa.lokasiowa_id')
                    ->groupBy('lokasiowa_id')
                    ->get();

            foreach ($owas as $nilai) {
                $penerimaan = $nilai->penerimaans;
                $pengunjung = $nilai->pengunjungs;
            }

            $list[] = array(
                'penerimaan' => $penerimaan,
                'pengunjung' => $pengunjung,
                'lokasi_owas' => $key->lokasi_owa,
                'latitude' => $key->latitude,
                'longitude' => $key->longitude,
                'data_owa' => $owas,
            );
            asort($list); //buat ngurutin berdasarkan penerimaan
        }

        Mapper::map(-7.5360639, 112.2384017,['marker' => false,  'type' => 'HYBRID']);
        $first = reset($list);
        $last = end($list);
        foreach ($list as $key) {
            if($key == $first){
                $icon = '/images/marker_hijau.png';
                $lokasi_rendah = $key['lokasi_owas'];
                $penerimaan_rendah = $key['penerimaan'];
                $pengunjung_rendah = $key['pengunjung'];
            }
            elseif($key == $last){
                $icon = '/images/marker_merah.png';
                $lokasi_tinggi = $key['lokasi_owas'];
                $penerimaan_tinggi = $key['penerimaan'];
                $pengunjung_tinggi = $key['pengunjung'];
            }
            else{
                $icon = '/images/marker_kuning.png';
            }

            $lokasi = $key['lokasi_owas'];
            Mapper::informationWindow(
                $key['latitude'], 
                $key['longitude'], 
                "<b>".$lokasi."</b><br><i>Pemasukan</i><br>Rp ".number_format((double)$key['penerimaan'], 0, ',', '.')."<br><i>Pengunjung</i><br>".number_format((double)$key['pengunjung'], 0, ',', '.')." <i>kali</i>", 
                ['icon' => $icon, 'title' => $lokasi,'animation' => 'DROP']
            );
        }

        $data[] = array(
                'lokasi_tinggi' => $lokasi_tinggi,
                'lokasi_rendah' => $lokasi_rendah,
                'penerimaan_tinggi' => $penerimaan_tinggi,
                'pengunjung_tinggi' => $pengunjung_tinggi,
                'penerimaan_rendah' => $penerimaan_rendah,
                'pengunjung_rendah' => $pengunjung_rendah,
            );

        return view('home', ['data' => $data]);

        // Mapper::map(-7.5360639, 112.2384017,['marker' => false,  'type' => 'HYBRID']);
        // foreach ($lokasi_owa as $key) {
        //     $icon = '/images/marker_merah.png';
        //     Mapper::informationWindow($key->latitude, $key->longitude, $key->lokasi_owa, ['icon' => $icon, 'title' => $key->lokasi_owa,'animation' => 'DROP']);
        // }

        //Sementara yak
        // Mapper::map(-7.5360639, 112.2384017,['marker' => false,  'type' => 'HYBRID'])
        // ->informationWindow(-7.79487415, 112.61047445, 'UPT TAHURA R.Soerjo',['draggable' => true, 'title' => 'UPT TAHURA R.Soerjo','animation' => 'DROP'])
        // ->informationWindow(-7.3828486999999985, 112.7574743, 'Ini Balai BKSDA',['draggable' => true, 'title' => 'Balai BKSDA Jatim','animation' => 'DROP'])
        // ->informationWindow(-7.87597375, 114.41369244999999, 'Balai TN Baluran',['draggable' => true, 'title' => 'Balai TN Baluran','animation' => 'DROP'])
        // ->informationWindow(-8.235892932845848, 114.35108390971754, 'Balai TN Alas Purwo',['draggable' => true, 'title' => 'Balai TN Alas Purwo','animation' => 'DROP'])
        // ->informationWindow(-8.193685299999999, 113.7204335, 'Balai TN Meru Betiri',['draggable' => true, 'title' => 'Balai TN Meru Betiri','animation' => 'DROP'])
        // ->informationWindow(-7.9760123499999995, 112.8010802 , 'Ini Bromo',['draggable' => true, 'title' => 'Balai BTN Bromo Tengger Semeru','animation' => 'DROP']);
        
        //Mapper::informationWindow($lat, $lng, 'content', ['markers' => ['symbol' => 'circle', 'icon' => '/path/to/image.png']]);
        
    }
}
