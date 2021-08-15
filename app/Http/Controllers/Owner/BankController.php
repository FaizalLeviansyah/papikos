<?php

namespace App\Http\Controllers\Owner;
use ErrorException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Owner\BankService;
use App\Http\Requests\BankRequest;

class BankController extends Controller
{
  protected $bank;

  public function __construct(BankService $bank)
  {
    $this->bank = $bank;
  }


  // Rekening
  public function rekening(BankRequest $request)
  {
    try {
      $result = $this->bank->rekening($request->all());
      return $result;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Rekening edit
  public function rekeningEdit($id)
  {
    try {
      $result = $this->bank->rekeningEdit($id);
      return $result;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Rekening Update
  public function rekeningUpdate($id)
  {
    try {
      $result = $this->bank->rekeningUpdate($id);
      return $result;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }
}
