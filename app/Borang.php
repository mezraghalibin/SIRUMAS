<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Borang extends Model
{
    protected $table = 'borang';
    //protected $fillable = array('nama_komp', 'id_proposal', 'staf_riset','nilai');
    protected $guarded = ['id'];
    public $timestamps = false;
 
}
