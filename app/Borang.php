<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Borang extends Model
{
    protected $table = 'borang';
    protected $fillable = array('komponen');
    protected $guarded = ['id'];
    public $timestamps = false;
 
}
