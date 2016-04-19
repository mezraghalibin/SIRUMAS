<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //TABLE
    
   // TABLE
    protected $table = 'proposal';
<<<<<<< HEAD
    protected $fillable = array('nama_pengaju', 'no_hp', 'e-mail','nip/nup','dosen', 'created_at', 'updated_at', 'kategori', 'status', 'judul_proposal', 'file', 'id_hibah');
    //protected $guarded = ['id_hibah'];
    //END OF TABLE

=======
   protected $fillable = array('nama_pengaju', 'no_hp', 'e-mail','nip/nup','dosen', 'created_at', 'updated_at', 'kategori', 'status', 'judul_proposal', 'file', 'id_hibah');
   //protected $guarded = ['id_hibah'];
>>>>>>> 763311fc63f21bd835352b44bb239f2f8954cfb1
}
