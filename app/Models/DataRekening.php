<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRekening extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','no_rekening','nama_bank','nama_pemilik','is_active'];
}
