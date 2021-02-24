<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowHeader extends Model
{
  use SoftDeletes;

  protected $table = 'borrow_headers';
  protected $fillable = [
    'tanggal_pinjam', 'total_buku', 'total_pinjam', 'user_id', 'anggota_id', 'edit_id'
  ];

  public function detail()
  {
    return $this->hasMany('App\Models\BorrowDetail', 'header_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function anggota()
  {
    return $this->belongsTo('App\Models\Member', 'anggota_id', 'id');
  }

  public function pengembalian()
  {
    return $this->hasOne('App\Models\LoanReturn', 'header_id', 'id');
  }
}
