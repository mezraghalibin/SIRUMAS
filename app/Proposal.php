<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';
    //protected $fillable = array('nama_komp', 'id_proposal', 'staf_riset','nilai');
    protected $guarded = ['id'];
 
}
