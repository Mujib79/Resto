<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipe extends Model
{
  protected $fillable = ['no_hidangan','no_bahan','jumlah','keterangan'];
}
