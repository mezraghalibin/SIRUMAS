<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanIlmiah extends Model
{
     //TABLE
    protected $table = 'kegiatan_ilmiah';
    protected $fillable = array('staf_riset', 'nama',
    	'jenis', 'skala', 'waktu','tempat','sumber_dana','pembicara','judul', 'bukti');
    protected $guarded = ['id'];
    public $timestamps = false;
}
