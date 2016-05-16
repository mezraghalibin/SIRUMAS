<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengmasAnggota extends Model
{
    //TABLE
    protected $table = 'pengmas_anggota';
    protected $fillable = array('id_pengmas', 'nama_anggota');
    protected $guarded = ['id'];
    public $timestamps = false;
}
