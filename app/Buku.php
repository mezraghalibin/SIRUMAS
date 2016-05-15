<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    //TABLE
    protected $table = 'buku';
    protected $fillable = array('judul', 'penulis', 'penerbit', 'isbn', 'tahun', 'sampul', 'staf_riset', 'jumlah_hlm', 'kota_terbit');
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getPenulis() {
    	return $this->hasMany('\App\Penulis_Ang_Buku', 'id_buku', 'id');
    }
}
