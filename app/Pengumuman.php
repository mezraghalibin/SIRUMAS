<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    //TABLE
    protected $table = 'pengumuman';
    protected $fillable = array('nomor', 'judul', 'status','kategori','konten');
    //protected $guarded = ['id'];
}
