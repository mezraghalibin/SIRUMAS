<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penulis_Ang_Buku extends Model {
  //TABLE
  protected $table = 'penulis_ang_buku';
  protected $fillable = array('id_buku', 'nama_anggota');
  protected $guarded = ['id'];
  public $timestamps = false;
}
