<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengmas extends Model
{
     //TABLE
    protected $table = 'pengmas';
    protected $fillable = array('staf_riset', 'nama_kegiatan', 'ketua', 'peranan', 
        'penyelenggara', 'tempat', 'waktu', 'besar_dana', 'nominal', 'bukti');
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getAnggota()
    {
    	return $this->hasMany('\App\PengmasAnggota', 'id_pengmas', 'id');
    }

}
