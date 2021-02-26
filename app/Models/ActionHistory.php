<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionHistory extends Model
{
  use SoftDeletes;

  protected $table = 'action_histories';
  protected $fillable = [
    'models', 'method', 'message', 'data_id', 'user_id'
  ];
}
