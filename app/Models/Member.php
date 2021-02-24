<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
  use SoftDeletes;

  protected $table = 'members';
  protected $fillable = [
    'nama_anggota', 'alamat_anggota', 'telp_anggota'
  ];
}
