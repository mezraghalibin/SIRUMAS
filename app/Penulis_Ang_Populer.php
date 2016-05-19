<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penulis_Ang_Populer extends Model {
  //TABLE
  protected $table = 'penulis_ang_populer';
  protected $fillable = array('id_artikel_populer', 'nama_anggota');
  protected $guarded = ['id'];
  public $timestamps = false;
}
