<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowDetail extends Model
{
  use SoftDeletes;

  protected $table = 'borrow_details';
  protected $fillable = [
    'header_id', 'buku_id', 'jumlah', 
  ];

  public function buku()
  {
    return $this->belongsTo('App\Models\Book', 'buku_id', 'id')->withTrashed();
  }
}
