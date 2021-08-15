<?php

namespace App\Services;
use ErrorException;
use App\Models\{User,DataRekening,Bank};
use Auth;
use Session;

class GlobalService {

  // Profile
  public function profile()
  {
    try {
      $listBank = Bank::all();
      $bank = DataRekening::where('user_id',Auth::id())->get();
      return view('global.profile.index', \compact('bank','listBank'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Profile Update
  public function profileUpdate($id, $data)
  {
    try {
      $result = User::find($id);
      $result->name   = $data['name'];
      $result->email  = $data['email'];
      $result->no_wa  = $data['no_wa'];
      $result->update();

      Session::flash('success','Profile berhasil di update.');
      return back();
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

}