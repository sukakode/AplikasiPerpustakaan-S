<?php

namespace App\Models;

use App\Models\CustomModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowHeader extends CustomModel
{
  use SoftDeletes;

  protected $table = 'borrow_headers';
  protected $fillable = [
    'tanggal_pinjam', 'total_buku', 'total_pinjam', 'user_id', 'anggota_id', 'new_id', 'edit_id'
  ];

  public function detail()
  {
    return $this->hasMany('App\Models\BorrowDetail', 'header_id', 'id')->withTrashed();
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id', 'id')->withTrashed();
  }

  public function anggota()
  {
    return $this->belongsTo('App\Models\Member', 'anggota_id', 'id')->withTrashed();
  }

  public function pengembalian()
  {
    return $this->hasOne('App\Models\LoanReturn', 'header_id', 'id');
  }
}
