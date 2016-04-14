<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoU extends Model
{
    //TABLE
    protected $table = 'mou_peneliti';
    protected $fillable = array('file', 'peneliti', 'judul','staf_riset');
    protected $guarded = ['id'];

    public function uploadMOU() {
    	
    }
}
