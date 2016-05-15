<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penelitian_Anggota extends Model {
  //TABLE
  protected $table = 'penelitian_anggota';
  protected $fillable = array('id_penelitian', 'nama_anggota');
  protected $guarded = ['id'];
  public $timestamps = false;
}
