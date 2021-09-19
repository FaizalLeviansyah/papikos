<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{kamar,provinsi,Testimoni,User,SimpanKamar};
use Auth;

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
      ->orderBy('created_at','DESC')
      ->paginate(12);

      return view('front.index', \compact('kamar'));
    }

    // Show Kamar
    public function showkamar($slug)
    {
      $kamar = kamar::with('province')->where('slug', $slug)->first();
      $fav = SimpanKamar::where('kamar_id',$kamar->id)->where('user_id',Auth::id())->first();
      $relatedKos = kamar::whereNotIn('slug', [$slug])
        ->where('province_id', [$kamar->province_id])
        ->limit(4)->get();

      return view('front.show', compact('kamar','relatedKos','fav'));
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

      ->orwhereHas('favorite', function($q) use ($cari){
        $q->where('user_id', 'like', "%".$cari."%")
        ->where('user_id', Auth::id());
      })
      ->orwhere('nama_kamar', 'like', "%".$cari."%")
      ->orderBy('created_at','DESC')
      ->paginate(12);

      $provinsi = Kamar::with('provinsi')->select('province_id')->groupby('province_id')->get();
      $select = [];
      $select['jenis_kamar'] = $request->jenis_kamar;
      $select['name']        = $request->nama_provinsi;
      $select['user_id']     = $request->user;
      return view('front.allCardContent', \compact('allKamar','select','provinsi','cari'));
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
        ->orderBy('created_at','DESC')
        ->paginate(20);
      } else {
        $allKamar = kamar::orderBy('created_at','DESC')->paginate(20);
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
      ->orderBy('created_at','DESC')
      ->paginate(12);
      return view('front.showByKota', \compact('kamar','kota'));
    }

    // Simpan kamar
    public function simpanKamar(Request $request)
    {
      $simpan = new SimpanKamar;
      $simpan->user_id  = Auth::id();
      $simpan->kamar_id = $request->id;
      $simpan->save();

      return back();
    }

    // Hapus kamar disimpan
    public function hapusKamar(Request $request)
    {
      $hapus = SimpanKamar::find($request->id);
      $hapus->delete();

      return back();
    }

}
