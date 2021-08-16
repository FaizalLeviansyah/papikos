@extends('layouts.front.app')
<style>
  .swiper {
    max-height: 455px !important;
  }

  .sticky {
    position: -webkit-sticky !important;
    position: sticky !important;
    top: 0;
    padding-top: 43px;
  }
</style>
@section('content')

<div class="row">
  <div class="col-lg-8">
    <h4 class="card-title">
      <a href="/" style="font-size: 15px;"><i class="feather icon-home"></i> Home ></a>
      <a href="" style="font-size: 15px;">Kos {{ucfirst(strtolower($kamar->provinsi->name))}} ></a>
      <a href="" style="font-size: 15px;">Kos {{ucfirst(strtolower($kamar->regencies->name))}} ></a>
      <a href="" style="font-size: 15px; color:black">{{$kamar->nama_kamar}}</a>
    </h4>
    <div class="card ">
      <div class="card-content">
        <div class="card-body ">
          <div class="swiper-navigations swiper-container swiper">
            <div class="swiper-wrapper">
              @foreach ($kamar->fotoKamar as $foto)
                <div class="swiper-slide">
                  <img class="img-fluid" src="{{url('images/foto_kamar', $foto->foto_kamar)}}" alt="banner">
                </div>
              @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- @foreach ($kamar->fotoKamar as $foto)
    <img src="{{url('images/foto_kamar', $foto->foto_kamar)}}" width="400px" height="300px">
  @endforeach --}}

  <div class="col-lg-4 sticky">
    <div class="card">
      <div class="card-content">
        <div class="card-body ">
          <img src="https://cdn.pixabay.com/photo/2018/08/28/13/29/avatar-3637561_1280.png" width="50px" height="50px" class="rounded">
          <span class="font-weight-bold" style="font-size: 20px; color:black;">{{getNameUser($kamar->user_id)}}</span>
          <p class="ml-5" style="font-size: 10px; margin-top:-3%">Pemilik Kos - Aktif Sejak {{monthyear($kamar->user->created_at)}} </p>
          <span class="btn btn-outline-primary btn-sm">{{getTransaksiSuccess(!empty($kamar->transaksi->user_id) ? $kamar->transaksi->user_id : '')}} Transaksi Berhasil</span>
          <span class="btn btn-outline-info btn-sm"> Total 20 Pelanggan</span>
          <p class="mt-1"> <i class="feather icon-phone-call"></i> @auth 082248885062 @else 0822******** @endauth </p>

          <p class="mt-2" style="font-size: 12px">Hubungi pemilik kos untuk menanyakan lebih detail terkait kamar ini.</p>
          <button class="btn btn-outline-black">Kirim pesan ke pemilik kos</button>
          <hr>
          <p class="mt-2" style="font-weight: bold; font-size:18px; color:black">DISKONNYA BIKIN HEMAT!</p>
          <span>Diskon sebesar Rp75.000* gunakan APIKMERDEKA</span> <br>
          <p class="mt-1" style="text-decoration: underline">Syarat & ketentuan berlaku</p>
          <ul>
            <li>Kuota terbatas</li>
            <li>Hanya berlaku untuk pengguna baru</li>
            <li>Periode 1 Agustus - 30 Oktober 2021</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h3>{{$kamar->nama_kamar}} {{ucfirst(strtolower($kamar->regencies->name))}} {{ucfirst(strtolower($kamar->provinsi->name))}}</h3>
        <button class="btn btn-outline-black btn-sm"><span style="font-size: 12px; font-weight:bold;">Kos {{$kamar->jenis_kamar}}</span></button>
        <div class="row">
          <div class="col-md-6 mt-1">
            <span style="font-weight:bold">Tersisa <span style="color: {{$kamar->sisa_kamar <= 5 ? 'red' : ''}}; font-weight:bold">{{$kamar->sisa_kamar}} kamar</span></span>
          </div>
          <div class="col-md-6 mt-1">
            <a class="btn btn-outline-black btn-sm" style="font-size: 12px; font-weight:bold;"> <i class="feather icon-heart"></i>  Simpan</a>
            <a class="btn btn-outline-black btn-sm" style="font-size: 12px; font-weight:bold;"> <i class="feather icon-share-2"></i>  Bagikan</a>
          </div>
        </div>
        <hr>

        <h3 style="font-weight: bold">Fasilitas</h3>
        <p style="font-size: 13px">
          <ol>
            <li>{{$kamar->listrik == 0 ? 'Tidak Termasuk Listrik' : 'Termasuk Listrik'}} <br></li>
            <li>Tidak Ada Minimum Pembayaran <br></li>
            <li>Diskon Jutaan</li>
          </ol>
          <hr style="border-top: 1px dashed ">
        </p>
        <h5 class="mt-1" style="font-weight: bold">Luas Kamar</h5>
        {{$kamar->luas_kamar}}

        <h5 class="mt-1" style="font-weight: bold">Fasilitas yang kamu dapatkan</h5>
        <div class="row">
          <p style="font-size: 13px">
            <div class="col-md-6">
              {{-- Fasilitas Kamar --}}
              @foreach ($kamar->fkamar as $fkamar)
                {{$fkamar->name}} <br>
              @endforeach

              {{-- Fasilitas Kamar Mandi --}}
              @foreach ($kamar->kmandi as $kmandi)
                {{$kmandi->name}} <br>
              @endforeach
            </div>
            <div class="col-md-6">
              {{-- Fasilitas Bersama --}}
              @foreach ($kamar->fbersama as $fbersama)
                {{$fbersama->name}} <br>
              @endforeach

              {{-- Fasilitas Parkir --}}
              @foreach ($kamar->fparkir as $fparkir)
                {{$fparkir->name}} <br>
              @endforeach
            </div>
          </p>
        </div>

        <h5 class="mt-1" style="font-weight: bold">Fasilitas umum</h5>
        <div class="d-flex justify-content-between">
          <p style="font-size: 13px">
            @foreach ($kamar->area as $area)
              {{$area->name}} <br>
            @endforeach
          </p>
        </div>

        <h5 class="mt-1" style="font-weight: bold">Keterangan Lain</h5>
        {{$kamar->ket_lain ?? '-'}}

        <h5 class="mt-1" style="font-weight: bold">Keterangan Biaya</h5>
        {{$kamar->ket_biaya ?? '-'}}

        <h5 class="mt-1" style="font-weight: bold">Peraturan selama ngekos</h5>
        {{$kamar->desc ?? '-'}}
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <form action="{{route('sewa.store', $kamar->id)}}" method="post">
          @csrf
          <span> {{rupiah($kamar->harga_kamar)}} / Bulan</span>
          <select class="DropChange" id="hargakamar" hidden>
            <option value="{{$kamar->harga_kamar}}" selected></option>
          </select>
          <div class="row">
            <div class="col-md-6 mt-1">
              <input type="text" name="tgl_sewa" class="form-control datepicker mr-2" placeholder="Mulai Kos"  autocomplete="off" required>
            </div>
            <div class="col-md-6 mt-1">
              <select name="lama_sewa" id="lamasewa" class="form-control DropChange">
              <option>Lama Sewa</option>
              <option value="1">1 Bulan</option>
              <option value="3">3 Bulan</option>
              <option value="6">6 Bulan</option>
              <option value="12">1 Tahun</option>
            </select>
            </div>
          </div>
          <small>Kamu bisa mengajukan kos 2 bulan dari sekarang.</small>
      </div>
    </div>
    <div class="card">
      <div class="card-body" id="tampil">
        <div class="d-flex justify-content-between">
          <div>
            <p>Harga Sewa <br>
              Biaya Admin <br>
              Deposit <br>
              Point
            </p>
          </div>
          <div>
            <p style="color: black">
              <span id="sewakamar"></span> <br>
              Rp. 10.000.00 <br>
              Rp. 300.000 <br>
              + 2 Points
            </p>
            <input type="hidden" class="DropChange" id="depost" value="300000">
            <input type="hidden" class="DropChange" id="biayadmin" value="10000">
            @auth
              <input type="hidden" class="DropChange" id="points" value="{{calculatePointUser(Auth::id())}}">
            @endauth
          </div>
        </div>
        <div class="mb-1 d-flex justify-content-between">
          @auth
          <div>
            <div class="custom-control custom-switch custom-switch-danger switch-md mr-2 mb-1">
              <input type="checkbox" name="credit" class="custom-control-input" id="useCredit" value="false">
              <label class="custom-control-label" for="useCredit">
              </label>
            </div>
          </div>
          <div>
          {{getPointUser(Auth::id())}} Points ( {{rupiah(calculatePointUser(Auth::id()))}} )
          </div>
          @endauth
        </div>
        <hr>
        <h5 style="font-weight: bold">Keterangan</h5>
        <ul>
          <li style="font-size: 12px"><span style="color:black">Harga Sewa</span> adalah harga kamar dalam jangka 1 bulan.</li>
          <li style="font-size: 12px"><span style="color:black">Biaya Admin</span> adalah biaya pelayanan yang di bebankan penyewa untuk Pap!Kos.</li>
          <li style="font-size: 12px"><span style="color:black">Deposit</span> adalah biaya untuk penjaminan selama penyewa masih menggunakan kamar/apartmenent, (biaya akan dikembalikan setelah masa sewa habis).</li>
          <li style="font-size: 12px"><span style="color:black">Point</span> adalah jumlah reward yang di dapatkan penyewa, point dapat di tukarkan untuk pembayaran.</li>
        </ul>
        <hr>
        <div class="d-flex justify-content-between">
          <div>
            <p style="text-decoration:underline; color:black">
              Total Pembayaran
            </p>
          </div>
          <div id="harga">
            <p style="color: black; font-weight:bold" id="hargatotal"></p>
          </div>
          <p id="show">
            <span style="color: black; font-weight:bold" id="hargatotalpoints"></span>
          </p>
        </div>

        @auth
          @if (Auth::user()->role == 'Pencari')
            <button type="submit" class="btn btn-success btn-block">Ajukan Sewa</button>
          @else
            <button disabled="disabled" class="btn btn-info btn-block">Hanya Login Sebagai Pencari</button>
            <small>Silahkan masuk menggunakan akun pencari untuk melanjutkan.</small>
          @endif
        @else
          <a href="{{route('login')}}" class="btn btn-outline-primary btn-block">Masuk</a>
        @endauth
      </div>
      </div>
    </form>
  </div>

</div>
@endsection