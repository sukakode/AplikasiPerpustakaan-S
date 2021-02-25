<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomModel extends Model
{
  public static function boot()
  {
    parent::boot();

    static::created(function($model) {
      DB::table('test')->insert([
        'test' =>  get_class($model) . " Created " . $model->id,
      ]);
    });

    static::updated(function($model) {
      DB::table('test')->insert([
        'test' =>  get_class($model) . " Updated " . $model->id,
      ]);
    });

    static::deleted(function($model) {
      DB::table('test')->insert([
        'test' =>  get_class($model) . " Deleted " . $model->id,
      ]);
    });
    
    static::restored(function($model) {
      DB::table('test')->insert([
        'test' =>  get_class($model) . " Restored " . $model,
      ]);
    });
  }
}
