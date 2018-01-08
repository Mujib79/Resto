<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ingredient extends Model
{
  protected $fillable = ['nama_bahan','keterangan'];
  public $timestamps = false;
}
