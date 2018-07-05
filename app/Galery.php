<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galeries';
    protected $fillable = ['gambar','deskripsi']; 
    public $timestamps = true; 
}
