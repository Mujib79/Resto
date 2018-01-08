<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
  protected $fillable = ['no_pemesanan','tanggal','perihal','konten'];
  public $timestamps = false;
  protected $table = 'feedbacks';
}
