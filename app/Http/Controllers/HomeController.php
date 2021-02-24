<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $role = auth()->user()->roles->first()->name;
      if ($role == "Super Admin") {
        return redirect(route('backend.main'));
      } else if ($role == "Admin") {
        return redirect(route('backend.main'));
      } else {
        return view('home');
      }
    }
}
