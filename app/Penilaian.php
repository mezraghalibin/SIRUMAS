<?php

namespace App;

Use App\Penilaian;

Use Session;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'menilai_proposal';
    protected $fillable = array('id_proposal', 'staf_riset','nilai_proposal');
    protected $guarded = ['id'];
    public $timestamps = false;
}
