<?php

namespace App;

Use App\NilaiProposal;

Use Session;

use Illuminate\Database\Eloquent\Model;

class NilaiProposal extends Model
{
    protected $table = 'komponen_nilai_proposal';
    protected $fillable = array('nama_komp', 'id_proposal', 'staf_riset','nilai');
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $casts = ['nama_komp' => 'array'];
}
