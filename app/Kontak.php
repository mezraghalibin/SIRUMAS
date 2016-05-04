<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    //TABLE
    protected $table = 'kontak';
    protected $fillable = array('phone', 'email', 'nama', 'foto', 'institusi', 'expertise', 'deskripsi');
    protected $guarded = ['id'];
    public $timestamps = false;
}
