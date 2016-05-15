<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    //TABLE
    protected $table = 'penelitian';
    protected $fillable = array('staf_riset', 'judul', 'ketua', 'nominal', 'besar_dana', 'sumber_dana', 'file');
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAnggota() {
    	return $this->hasMany('\App\Penelitian_Anggota', 'id_penelitian', 'id');
    }

    public function getMhsTerlibat() {
    	return $this->hasMany('\App\Mahasiswa_Terlibat', 'id_penelitian', 'id');
    }
}
