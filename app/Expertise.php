<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model {
  //TABLE
  protected $table = 'expertise';
  protected $fillable = array('id_kontak', 'expertise');
  protected $guarded = ['id'];
  public $timestamps = false;
}
