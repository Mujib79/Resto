<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ingredient_detail extends Model
{
  public $timestamps = false;
    protected $fillable = ['no_bahan','no_reg','tgl_beli','tgl_produksi',
          'tgl_kadaluarsa','jumlah','keterangan'];
    protected $table = 'ingredient_details';
}
