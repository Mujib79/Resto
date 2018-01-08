<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
  protected $fillable = ['no_hidangan','nama_hidangan','kode_tipe','harga',
          'komposisi','cara_buat','status','NIP','life_cycle','created_at','updated_at'];
}
