<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPresentasi extends Model
{
    //TABLE
    protected $table = 'jadwal_presentasi';
    protected $fillable = array('id_laporan', 'waktu', 'status', 'dosen', 'reviewer', 'ruang', 'gedung', 'staf_riset');
    //protected $guarded = ['id'];
    public $timestamps = false;
}
