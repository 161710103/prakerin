<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profils extends Model
{
    protected $table = 'profils';
    protected $fillable = ['judul','deskripsi']; 
    public $timestamps = true; 
}
