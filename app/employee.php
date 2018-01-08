<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
  //atribut
  public $timestamps = false;
  protected $fillable = ['NIP','nama','jabatan',
          'kelamin','masuk','telepon','alamat','password','status'];

}
