<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hibah extends Model
{
    //TABLE
    protected $table = 'hibah';
    protected $fillable = array('nama_hibah', 'deskripsi', 'kategori_hibah',
    	'besar_dana','pemberi','tgl_awal','tgl_akhir','staf_riset');
    protected $guarded = ['id'];
    //public $timestamps = false;
}
