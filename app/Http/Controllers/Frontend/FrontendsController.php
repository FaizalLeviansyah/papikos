<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{kamar,provinsi,Testimoni,User};

class FrontendsController extends Controller
{

    // Homepage
    public function homepage(Request $request)
    {
      $cari = $request->cari;

      $kamar = kamar::whereHas('provinsi', function($q) use ($cari) {
        $q->where('name', 'like', "%".$cari."%")
        ;
      })
      ->orwhereHas('regencies', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhereHas('district', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhere('nama_kamar', 'like', "%".$cari."%")
      ->paginate(12);

      return view('front.index', \compact('kamar'));
    }

    // Show Kamar
    public function showkamar($slug)
    {
      $kamar = kamar::where('slug', $slug)->first();

      return view('front.show', compact('kamar'));
    }

    // Show semua kamar
    public function showAllKamar(Request $request)
    {
      $cari = $request->cari;
      $allKamar = kamar::whereHas('provinsi', function($q) use ($cari) {

        $q->where('name', 'like', "%".$cari."%")
        ;
      })
      ->orwhereHas('regencies', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhereHas('district', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhere('nama_kamar', 'like', "%".$cari."%")
      ->paginate(12);

      $provinsi = Kamar::with('provinsi')->select('province_id')->groupby('province_id')->get();
      $select = [];
      $select['jenis_kamar'] = $request->jenis_kamar;
      $select['name']        = $request->nama_provinsi;
      return view('front.allCardContent', \compact('allKamar','select','provinsi'));
    }

    // Filter kamar
    public function filterKamar(Request $request)
    {
      if ($request->nama_provinsi != 'all' && $request->jenis_kamar != 'all') {
        $allKamar = kamar::whereHas('provinsi', function($q) use ($request) {
          $q->where('name', $request->nama_provinsi);
        })
        ->where('jenis_kamar', $request->jenis_kamar)
        ->paginate(20);
      } elseif($request->nama_provinsi == 'all' && $request->jenis_kamar != 'all') {
        $allKamar = kamar::where('jenis_kamar', $request->jenis_kamar)->paginate(20);
      } elseif($request->nama_provinsi != 'all' && $request->jenis_kamar == 'all') {
          $allKamar = kamar::whereHas('provinsi', function($q) use ($request) {
          $q->where('name', $request->nama_provinsi);
        })
        ->paginate(20);
      } else {
        $allKamar = kamar::paginate(20);
      }


      $select = [];
      $select['jenis_kamar'] = $request->jenis_kamar;
      $select['name']        = $request->nama_provinsi;

      // select provinsi
      $provinsi = Kamar::with('provinsi')->select('province_id')->groupby('province_id')->get();
      return view('front.allCardContent', \compact('allKamar','select','provinsi'));
    }

    // Show by kota
    public function showByKota(Request $request)
    {
      $kota = $request->kota;
      $kamar = kamar::whereHas('provinsi', function($q) use ($kota) {
        $q->where('name', 'like', "%".$kota."%");
      })
      ->orwhereHas('regencies', function($q) use ($kota){
        $q->where('name', 'like', "%".$kota."%");
      })
      ->paginate(12);
      return view('front.showByKota', \compact('kamar','kota'));

    }

}
