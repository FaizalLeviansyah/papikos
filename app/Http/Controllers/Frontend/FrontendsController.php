<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{kamar,provinsi,Testimoni,User};

class FrontendsController extends Controller
{
    // Homepage
    public function homepage()
    {
      $kamar = kamar::paginate(8);
      return view('front.index', \compact('kamar'));
    }

    // Show Kamar
    public function showkamar($slug)
    {
      $kamar = kamar::where('slug', $slug)->first();
      return view('front.show', compact('kamar'));
    }

    public function cariKamar(Request $request)
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

}
