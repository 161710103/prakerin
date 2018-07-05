<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
 protected $table = 'programs'; 
    protected $fillable = ['judul','deskripsi','gambar','id_kategori']; 
    public $timestamps = true; 

    public function Kategori()
    {
    	return $this->belongsTo('App\Kategori','id_kategori');
    }
}