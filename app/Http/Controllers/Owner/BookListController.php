<?php

namespace App\Http\Controllers\Owner;

use ErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Owner\BookingListService;
class BookListController extends Controller
{
    protected $booking;

    public function __construct(BookingListService $booking)
    {
      $this->booking = $booking;
    }
    //Booking List
    public function index()
    {
      try {
        $result = $this->booking->index();
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    // Konfirmasi Pembayaran from user
    public function confirm_payment()
    {
      try {
        $result = $this->booking->confirm_payment();
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    // Proses konfirmasi pembayaran from user
    public function proses_confirm_payment($id)
    {
      try {
        $result = $this->booking->proses_confirm_payment($id);
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    // Proses konfirmasi pembayaran from user
    public function reject_confirm_payment(Request $request)
    {
      try {
        $result = $this->booking->reject_confirm_payment($request->id);
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

}
