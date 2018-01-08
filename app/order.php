<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
  protected $fillable = ['no_pemesanan','no_meja','tanggal',
          'status_bayar','no_harian'];
  public $timestamps = false;
}
