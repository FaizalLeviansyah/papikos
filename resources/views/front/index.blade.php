@extends('layouts.front.app')
@section('description')
  Papikos, cari kos dan apartement makin mudah hanya di papikos. aplikasi pencari kos di indonesia.
@endsection
@section('title')
  Selamat Datang di Pap!Kos
@endsection


@section('content')
  @include('front.banner')
  <br><br><br>
  @include('front.sliderCard')
  <br><br><br>
  @include('front.cardContent')
  <br><br><br>
  @include('front.byKota')

@endsection