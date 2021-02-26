<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\CustomModel;

class Book extends CustomModel
{
  use SoftDeletes;

  protected $table = 'books';
  protected $fillable = [
    'judul', 'penerbit', 'pengarang', 'tahun'
  ];
  
}
