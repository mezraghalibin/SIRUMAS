<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtikelPopuler extends Model
{
    //TABLE
    protected $table = 'artikel_populer';
    protected $fillable = array('id', 'staf_riset', 'judul', 'penulis_utama', 'dimuat_di', 
    	'issn', 'no', 'halaman', 'tahun', 'url', 'penerbit', 'bukti');
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAnggota() {
    	return $this->hasMany('\App\Penulis_Ang_Populer', 'id_artikel_populer', 'id');
    }
}
