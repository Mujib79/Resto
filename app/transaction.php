<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
  protected $fillable = ['no_pemesanan','no_hidangan',
          'jml_item','catatan','status_buat'];
  public $timestamps = false;
}
