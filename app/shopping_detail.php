<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shopping_detail extends Model
{
  protected $fillable = ['no_detail','no_report','no_bahan',"satuan","jumlah","keterangan"];
  public $timestamps = false;
}
