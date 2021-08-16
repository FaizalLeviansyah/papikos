@extends('layouts.front.app')
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