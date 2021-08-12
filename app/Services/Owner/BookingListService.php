<?php

namespace App\Services\Owner;
use ErrorException;
use Auth;
use Session;
use Carbon\carbon;
use App\Models\{Transaction,kamar,payment,User};

class BookingListService {

  // Booking List
  public function index()
  {
    try {
      if (!empty(Auth::user()->kamar->id)) {
        $booking = Transaction::where('pemilik_id', Auth::id())->orderBy('created_at','DESC')->get();
        return view('pemilik.booking.index', compact('booking'));
      } else {
        Session::flash('error','Data Kamar Masih Kosong');
        return redirect('/home');
      }
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }


  // Konfirmasi Pembayaran
  public function confirm_payment($key)
  {
    try {
      $confirm = Transaction::where('key', $key)->where('status','Pending')->first();
      if ($confirm) {
        return view('pemilik.booking.confirm', compact('confirm'));
      }
      Session::flash('success','Payment Sudah Di Proses');
      return redirect('/pemilik/booking-list');
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Proses konfirmasi pembayaran
  public function proses_confirm_payment($key)
  {
    try {
      $confirm = Transaction::where('key',$key)->first();
      $confirm->status      = 'Proses';
      $confirm->updated_at  = Carbon::now();
      $confirm->save();

      if ($confirm) {
        $kamar = kamar::where('id', $confirm->kamar_id)->first();
        $kamar->sisa_kamar = $kamar->sisa_kamar - 1;
        $kamar->save();
        if ($kamar) {
          // Add credit point
          $point = User::where('id', $confirm->user_id)->firstOrFail();
          $point->credit  = $point->credit + 2;
          $point->save();
        }
      }
      Session::flash('success','Konfirmasi Pembayaran Sukses.');
      return redirect('/pemilik/booking-list');
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Reject konfirmasi pembayaran
  public function reject_confirm_payment($params)
  {
    try {
      $reject = Transaction::findOrFail($params);
      $reject->update([
        'status'      => 'Reject',
        'updated_at'  => carbon::now()
      ]);
      Session::flash('error','Pembayaran Berhasil Di Reject');
      return redirect('/pemilik/booking-list');
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }
}