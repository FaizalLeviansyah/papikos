@extends('layouts.frontend.index')
@section('title')
  {{$kamar->nama_kamar}}
@endsection
@section('card')
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-3 mb-3">
      <div class="card shadow">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://cdn.pixabay.com/photo/2014/08/11/21/39/wall-416060_1280.jpg" class="d-block w-100" style="height: 350px" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://cdn.pixabay.com/photo/2015/10/20/18/57/furniture-998265_1280.jpg" class="d-block w-100" style="height: 350px" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://cdn.pixabay.com/photo/2014/12/27/14/37/living-room-581073_1280.jpg" class="d-block w-100" style="height: 350px" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mt-3 mb-3">
      <div class="card shadow" style="height: 350px">
        <div class="d-flex" style="margin: 5%">
          <img src="https://cdn.pixabay.com/photo/2018/08/28/13/29/avatar-3637561_1280.png" width="50px" height="50px" class="rounded">
          <div class="pl-3">
            <span class="font-weight-bold" style="font-size: 20px; color:black">{{getNameUser($kamar->user_id)}}</span>
            <p style="font-size: 12px; margin-top:-5%">Pemilik - Aktif Sejak {{monthyear($kamar->user->created_at)}} </p>
          </div>
        </div>
        <div class="pl-3">
          <i class="fas fa-calendar-check mr-1" style="color: darkolivegreen"></i>
          <span style="color: black">{{getTransaksiSuccess(!empty($kamar->transaksi->user_id) ? $kamar->transaksi->user_id : '')}} Transaksi Berhasil</span> <br>

          <button class="btn btn-outline-info btn-sm mt-5">Tanya Pemilik Kos</button>
        </div>

      </div>
    </div>

    {{-- Detail --}}
    <div class="col-md-8 col-sm-12 col-12 mb-3">
      <div class="card shadow">
        <div class="card-body">
          <p class="font-weight-bold" style="font-size: 20px; color:black"> {{$kamar->nama_kamar}} </p>
          <div class="mb-3">
            <span style=" color:black">
              Kos {{$kamar->jenis_kamar}} - <i class="fa fa-map-marked-alt"></i> {{getNameProvinsi($kamar->province_id)}}, {{getNameRegency($kamar->regency_id)}}, {{getNameDistrict($kamar->district_id)}}
            </span>
          </div>
          <div class="mb-3">
            <span style="color: black">
            Tersisa {{$kamar->sisa_kamar}} Kamar
            </span>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              <p style="font-size: 14px">
                Terakhir diupdate {{forDate($kamar->updated_at)}}
              </p>
            </div>
            <div>
              <p style="font-size: 14px">
                Simpan <i class="fa fa-heart"></i>
              </p>
            </div>
          </div>
          <hr>
          <h6 style="color: black">Fasilitas</h6>
          <p style="font-size: 14px">
            {{$kamar->listrik == 0 ? 'Tidak Termasuk Listrik' : 'Termasuk Listrik'}} <br>
            Tidak Ada Minimum Pembayaran <br>
            Diskon Jutaan
          </p>
          <hr>
          <h6 style="color: black">Luas Kamar</h6>
          <p style="font-size: 14px">
            {{$kamar->luas_kamar}}
          </p>
          <h6 style="color: black">Fasilitas Yang Didapat</h6>
          <p style="font-size: 14px">
            <div class="row">
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
            </div>
          </p>
          <h6 style="color: black">Fasilitas Umum</h6>
          <div class="d-flex justify-content-between">
            <p style="font-size: 14px">
              {{-- Fasilitas Umum --}}
              @foreach ($kamar->area as $area)
                {{$area->name}} <br>
              @endforeach
            </p>
          </div>

          <h6 style="color: black">Keterangan Lain</h6>
          <div class="mb-3">
             {{$kamar->ket_lain ?? '-'}}
          </div>

          <h6 style="color: black">Keterangan Biaya</h6>
          <div class="mb-3">
             {{$kamar->ket_biaya ?? '-'}}
          </div>

          <h6 style="color: black">Peraturan selama ngekos</h6>
          <div class="mb-3">
             {{$kamar->desc ?? '-'}}
          </div>
        </div>
      </div>
    </div>

    {{-- Proses --}}
    <div class="col-md-4 col-sm-12 col-12 mb-3">
      <form action="{{route('sewa.store', $kamar->id)}}" method="post">
        @csrf
        <div class="card shadow">
          <div class="card-body">
            <p> {{rupiah($kamar->harga_kamar)}} / Bulan</p>
            <select class="DropChange" id="hargakamar" hidden>
              <option value="{{$kamar->harga_kamar}}" selected></option>
            </select>
            <div class="d-flex">
              <input type="text" name="tgl_sewa" class="form-control datepicker mr-2" id="datepicker" placeholder="Mulai Kos"  autocomplete="off" required>
              <select name="lama_sewa" id="lamasewa" class="form-control datepicker DropChange">
                <option>Lama Sewa</option>
                <option value="1">1 Bulan</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">1 Tahun</option>
              </select>
            </div>
            <small>Kamu bisa mengajukan kos 2 bulan dari sekarang.</small>
          </div>
        </div>
        <div class="card shadow">
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
            <div class="mb-3 d-flex justify-content-between">
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
            <div class="d-flex justify-content-between">
              <div>
                <p style="text-decoration:underline; color:black">
                  Total Pembayaran
                </p>
              </div>
              <div id="harga">
                <p style="color: black" id="hargatotal"></p>
              </div>
              <p id="show">
                <span style="color: black" id="hargatotalpoints"></span>
              </p>
            </div>

            @auth
              @if (Auth::user()->role == 'Pencari')
                <button type="submit" class="btn btn-success btn-block">Ajukan Sewa</button>
              @else
                <button disabled="disabled" class="btn btn-info btn-block">Hanya Login Sebagai Pencari</button>
              @endif
            @else
              <a href="{{route('login')}}" class="btn btn-outline-primary btn-block">Masuk</a>
            @endauth
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection