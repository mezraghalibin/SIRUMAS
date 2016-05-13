<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    //TABLE
    protected $table = 'penelitian';
    protected $fillable = array('staf_riset', 'judul', 'ketua', 'besar_dana', 'sumber_dana', 'file');
    protected $guarded = ['id'];
    public $timestamps = false;
}
