<?php

namespace App\Http\Controllers;

use App\LokasiOwa;
use App\Owa;
use App\Wisata;
use App\LuasHutan;
use App\JenisHutan;
use App\Kabupaten;
use App\DataLuas;
use App\JenisDataLuas;
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

        // Dapt tahun sekarang
        // date_default_timezone_set("Asia/Jakarta");
        // $tahun = date('Y');
        $tahun = 2016;
        //dd($tahun);

        // if (is_null($tahun = $request->get('years')) ) {
        //     // date_default_timezone_set("Asia/Jakarta");
        //     // $tahun = date('Y');
        //     $tahun = 2016;
        // }
        // else{
        //     $tahun = $request->get('years');
        // }

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

        //GRAFIK LUAS HUTAN
        $jenis_hutan = JenisHutan::all();

        foreach ($jenis_hutan as $key) {
            $luas_hutan = LuasHutan::select('*',DB::raw('SUM(luas) as luass'))
            ->where('jenis_hutan_id', '=', $key->id)
            ->where(DB::raw('tanggal'), '=', $tahun)
            ->join('jenis_hutan','jenis_hutan.id', '=', 'luas_hutan.jenis_hutan_id')
            ->groupBy('jenis_hutan_id')
            ->get();

            foreach ($luas_hutan as $keys) {
                $luas = $keys->luass;
            }

            $hutans[] = array(
                'luas' => $luas,
                'jenis_hutan' => $key->jenis_hutan,
                'id' => $key->id,
            );
        }
        //dd($hutans);
        // AKHIR GRAFIK LUAS HUTAN

        // AWAL GRAFIK LUAS BALAI
        foreach ($lokasi_owa as $key) {
            $tahun_lahan_kritis = DataLuas::select('luas','tahun')
            ->where('lokasiowa_id', '=', $key->id)
            ->where('jenis_data_id', '=', 1)
            ->max('tahun');

            $lahan_kritis = DataLuas::select('luas','tahun')
            ->where('lokasiowa_id', '=', $key->id)
            ->where('jenis_data_id', '=', 1)
            ->where('tahun', '=', $tahun_lahan_kritis)
            ->get();

            foreach ($lahan_kritis as $key1) {
                $luas_lahan_kritis = $key1->luas;
                $tahun_lahan_kritis = $key1->tahun;
            }

            if(is_null($tahun_lahan_kritis)){
                $luas_lahan_kritis = 0;
            }

            $tahun_kebakaran = DataLuas::select('luas','tahun')
            ->where('lokasiowa_id', '=', $key->id)
            ->where('jenis_data_id', '=', 2)
            ->max('tahun');

            $kebakaran = DataLuas::select('luas','tahun')
            ->where('lokasiowa_id', '=', $key->id)
            ->where('jenis_data_id', '=', 2)
            ->where('tahun', '=', $tahun_kebakaran)
            ->get();

            foreach ($kebakaran as $key1) {
                $luas_kebakaran = $key1->luas;
                $tahun_kebakaran = $key1->tahun;
            }

            if(is_null($tahun_kebakaran)){
                $luas_kebakaran = 0;
            }

            $balai[] = array(
                'nama_balai' => $key->lokasi_owa,
                'luas_wilayah' => $key->luas_wilayah,
                'luas_lahan_kritis' => $luas_lahan_kritis,
                'tahun_lahan_kritis' => $tahun_lahan_kritis,
                'luas_kebakaran' => $luas_kebakaran,
                'tahun_kebakaran' => $tahun_kebakaran,
            );
        }
        //dd($balai);
        // AKHIR GRAFIK LUAS BALAI

        //A W A L   M A P
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

        //Wisata
        // $wisata = Wisata::all();
        // foreach ($wisata as $key) {
        //     if(is_null($key->latitude)){
        //         continue;
        //     }
        //     else{
        //         Mapper::informationWindow(
        //             $key->latitude, 
        //             $key->longitude, 
        //             $key->wisata, 
        //             ['title' => $key->wisata,'animation' => 'DROP']
        //         );
        //     }
        // }

        $data[] = array(
                'lokasi_tinggi' => $lokasi_tinggi,
                'lokasi_rendah' => $lokasi_rendah,
                'penerimaan_tinggi' => $penerimaan_tinggi,
                'pengunjung_tinggi' => $pengunjung_tinggi,
                'penerimaan_rendah' => $penerimaan_rendah,
                'pengunjung_rendah' => $pengunjung_rendah,
            );

        return view('home', ['data' => $data,
                             'now' => $tahun,
                             'total' => $total,
                             'total_lama' => $total_lama,
                             'tahun' => $tahun,
                             'hutan' => $hutans,
                             'balai' => $balai,
                             'persen_pengunjungs' => $persen_pengunjungs,
                             'persen_penerimaans' => $persen_penerimaans,
                             'total' => $total,
                             'persen_pengunjungs' => $persen_pengunjungs,
                             'persen_penerimaans' => $persen_penerimaans,
                             'ramal_pengunjung' => $ramal_pengunjung,
                             'ramal_penerimaan' => $ramal_penerimaan,
                             'err_pengunjung' => $err_pengunjung,
                             'err_penerimaan' => $err_penerimaan,
                            ]);

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
        // A K H I R   M A P
        
    }
}
