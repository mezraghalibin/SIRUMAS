<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_Terlibat extends Model {
  //TABLE
  protected $table = 'mahasiswa_terlibat';
  protected $fillable = array('id_penelitian', 'nama_mhs');
  protected $guarded = ['id'];
  public $timestamps = false;
}
