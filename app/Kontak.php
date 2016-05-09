<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model {
    //TABLE
    protected $table = 'kontak';
    protected $fillable = array('phone', 'email', 'nama', 'foto', 'institusi', 'deskripsi');
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getExpertise() {
    	return $this->hasMany('\App\Expertise', 'id_kontak', 'id');
    }
}
