<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penulis_Ang_Ilmiah extends Model {
  //TABLE
  protected $table = 'penulis_ang_ilmiah';
  protected $fillable = array('id_artikel_ilmiah', 'nama_anggota');
  protected $guarded = ['id'];
  public $timestamps = false;
}
