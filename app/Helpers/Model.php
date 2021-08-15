<?php
use App\Models\{Province,Regency,District,User,payment,Transaction};

// Ambil nama provinsi by id
if (! function_exists('getNameProvinsi'))
{
    function getNameProvinsi($id=0)
    {
        $model = new Province;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Ambil nama kota by id
if (! function_exists('getNameRegency'))
{
    function getNameRegency($id=0)
    {
        $model = new Regency;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Ambil nama district by id
if (! function_exists('getNameDistrict'))
{
    function getNameDistrict($id=0)
    {
        $model = new District;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Format Rupiah
if (! function_exists('rupiah'))
{
    function rupiah($angka)
    {
      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
      return $hasil_rupiah;
    }
}

// Format date
if (! function_exists('forDate'))
{
    function forDate()
    {
      $showdate = date('d F Y');
      return $showdate;
    }
}

// Show bulan dan tahun
if (! function_exists('monthyear'))
{
    function monthyear()
    {
      $showdate = date('F Y');
      return $showdate;
    }
}

// Ambil nama user by id
if (! function_exists('getNameUser'))
{
    function getNameUser($id=0)
    {
        $model = new User;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}


// Get transaksi sukses
if (! function_exists('getTransaksiSuccess'))
{
    function getTransaksiSuccess($user_id=0)
    {
      $model = new Transaction;
      $data  = $model::where('user_id',$user_id)->where('status','Proses')->get();
      $transaksi = !empty($data) ? $data->count() : '0';
      return $transaksi;
    }
}

// Get point/credit user
if (! function_exists('getPointUser'))
{
    function getPointUser($id=0)
    {
      $model = new User;
      $data  = $model::select('id','credit')->where('id',$id)->first();
      $transaksi = !empty($data) ? $data->credit : '0';
      return $transaksi;
    }
}

// Calculate point/credit user
if (! function_exists('calculatePointUser'))
{
    function calculatePointUser($id=0)
    {
      $model = new User;
      $data  = $model::select('id','credit')->where('id',$id)->first();
      $cal = $data->credit * 2000;
      $transaksi = !empty($cal) ? $cal : '0';
      return $transaksi;
    }
}