<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    //TABLE
    protected $table = 'pesan_user';
    protected $fillable = array('subjek', 'penerima', 'pesan','file','id_pengirim');
    protected $guarded = ['id'];

}
