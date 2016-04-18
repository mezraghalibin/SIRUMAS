<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoU extends Model
{
    //TABLE
    protected $table = 'mou_peneliti';
    protected $fillable = array('file', 'peneliti', 'judul','staf_riset', 'updated_by');
    protected $guarded = ['id'];
    public $timestamps = false;
}
