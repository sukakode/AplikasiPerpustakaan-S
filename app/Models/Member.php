<?php

namespace App\Models;

use App\Models\CustomModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends CustomModel
{
  use SoftDeletes;

  protected $table = 'members';
  protected $fillable = [
    'nama_anggota', 'alamat_anggota', 'telp_anggota'
  ];
}
