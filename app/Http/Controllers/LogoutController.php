<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LogoutController extends Controller
{
  public function index()
  {
      auth()->logout();
      auth('doctor')->logout();
      return view('home');
  }
}
