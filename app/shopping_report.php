<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shopping_report extends Model
{
  protected $fillable = ['no_report','tanggal','budget',"updated_at"];
  // public $timestamps = false;
}
