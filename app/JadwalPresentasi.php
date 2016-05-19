<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPresentasi extends Model
{
    //TABLE
    protected $table = 'jadwal_presentasi';
    protected $fillable = array('id_laporan', 'waktu', 'waktu_akhir','tanggal', 
    	'status','flag_presentasi', 'reviewer', 'ruang', 'gedung', 'staf_riset');
    protected $guarded = ['id'];
    public $timestamps = false;
}
