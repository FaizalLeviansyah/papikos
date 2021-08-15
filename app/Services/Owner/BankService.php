<?php
namespace App\Services\Owner;
use ErrorException;

use App\Models\DataRekening;
use Auth;
use Session;

class BankService {

  // Data Rekening Store
  public function rekening($data)
  {
    try {
      $bank = DataRekening::where('user_id', Auth::id())->count();

      if ($bank == 3) {
           Session::flash('error','Maksimal akun bank hanya boleh 3 akun.');
      } else {
        $result = DataRekening::create([
          'user_id'     => Auth::id(),
          'no_rekening' => $data['no_rekening'],
          'nama_bank'   => $data['nama_bank'],
          'nama_pemilik'=> $data['nama_pemilik'],
          'is_active'   => $data['is_active'] ?? 0,
        ]);
        Session::flash('success','Rekening bank berhasil di simpan.');
        $result->save();
      }
      return back();
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Edit Rekening
  public function rekeningEdit($id)
  {
    try {
      $bank = DataRekening::find($id);
      return $bank;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Update Rekening
  public function rekeningUpdate($id)
  {
    try {
      $bank = DataRekening::find($id);
      if ($bank->is_active == 0) {
        $bank->is_active == 1;
      } else {
        $bank->is_active == 0;
      }
      $bank->update;
      return $bank;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }
}