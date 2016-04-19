<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
	// TABLE
    protected $table = 'proposal';
    protected $fillable = array('nama_pengaju', 'no_hp', 'e-mail','nip/nup','dosen',
    	 'created_at', 'updated_at', 'kategori', 'status', 'judul_proposal', 'file', 'id_hibah');
    //protected $guarded = ['id_hibah'];
    //END OF TABLE  
}
