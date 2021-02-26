<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActionHistory;
use App\User;
use Illuminate\Support\Facades\Auth;

class CustomModel extends Model
{
  public static function boot()
  {
    parent::boot();

    $user = Auth::check() == 1 ? Auth::user() : User::whereHas('roles', function($q) { $q->where('name', '=', 'Super Admin'); })->first();

    static::created(function($model) use ($user) {
      if ($user != null) {
        ActionHistory::create([
          'models' => get_class($model),
          'method' => 'created',
          'message' => 'Melakukan Penambahan Data',
          'data_id' => $model->id,
          'user_id' => $user->id,
        ]);
      }

    });

    static::updated(function($model) use ($user) {
      if ($user != null) {
        ActionHistory::create([
          'models' => get_class($model),
          'method' => 'updated',
          'message' => 'Melakukan Perubahan Data',
          'data_id' => $model->id,
          'user_id' => $user->id,
          ]);
        }
    });

    static::deleted(function($model) use ($user) {
      if ($user != null) {
        ActionHistory::create([
          'models' => get_class($model),
          'method' => 'deleted',
          'message' => 'Melakukan Penghapusan Data',
          'data_id' => $model->id,
          'user_id' => $user->id,
        ]);
      }
    });
    
    static::restored(function($model) use ($user) {
      if ($user != null) {
        ActionHistory::create([
          'models' => get_class($model),
          'method' => 'restored',
          'message' => 'Melakukan Pemulihan Data',
          'data_id' => $model->id,
          'user_id' => $user->id,
        ]);
      }
    });
  }
}
