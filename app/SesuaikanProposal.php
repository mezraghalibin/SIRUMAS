<?php

namespace App;

use Session;

use App\SesuaikanProposal;

use Illuminate\Database\Eloquent\Model;

class SesuaikanProposal extends Model
{
    protected $table = 'menyesuaikan_keuangan';
    //protected $fillable = array('komentar');
    protected $guarded = ['id'];
}
