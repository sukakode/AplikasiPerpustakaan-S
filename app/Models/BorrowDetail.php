<?php

namespace App\Models;

use App\Models\CustomModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowDetail extends CustomModel
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
