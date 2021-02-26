<?php

namespace App\Models;

use App\Models\CustomModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanReturn extends CustomModel
{
  use SoftDeletes;

  protected $table = 'loan_returns';
  protected $fillable = [
    'header_id', 'tgl_kembali', 'keterlambatan', 'denda', 'denda_lainnya', 'keterangan', 'user_id'
  ];

  public function header()
  {
    return $this->belongsTo('App\Models\BorrowHeader', 'header_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id', 'id');
  }
}
