<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
  public function index()
  {
    // return view('welcome');
    return redirect(route('login'));
  }
}
