<section class="ftco-section bg-light">
  <div class="container">
    <div class="row mb-5">
      @foreach ($kamar as $kamars)
      <a href="{{url('room', $kamars->slug)}}">
        <div class="col-md-4 col-sm-4 col-12">
          <div class="card shadow">
            <img class="card-img-top" src="{{asset('images/bg_foto/' .$kamars->bg_foto)}}" alt="Card image cap">
            <div class="card-body">
              <div class="d-flex-justify-content-between">
                <span class="badge badge-light">{{$kamars->jenis_kamar}}</span>
                <span class="badge badge-info">Tersisa {{$kamars->sisa_kamar}} Kamar</span>
              </div>
              <span class="card-text"><a href="{{url('room', $kamars->slug)}}" style="color: black;">{{$kamars->nama_kamar}}</a></span> <br>
              <span style="font-size:13px; color:black"> <i class="fa fa-map-marker-alt"></i> {{$kamars->provinsi->name}} </span>
              <div class="d-flex justify-content-between">
                <p style="font-size: 12px; color:black">
                  {{rupiah($kamars->harga_kamar)}} / Bulan
                </p>
                <p style="font-size: 12px; color:black">Bisa Booking</p>
              </div>

            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>