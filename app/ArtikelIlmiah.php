<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtikelIlmiah extends Model
{
    //TABLE
    protected $table = 'artikel_ilmiah';
    protected $fillable = array('id', 'staf_riset', 'judul', 'penulis_utama', 'nama_jurnal', 'level', 
    	'issn', 'no', 'volume', 'tahun', 'halaman', 'url', 'penerbit', 'bukti');
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAnggota() {
    	return $this->hasMany('\App\Penulis_Ang_Ilmiah', 'id_artikel_ilmiah', 'id');
    }
}
