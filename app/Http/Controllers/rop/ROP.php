<?php

namespace App\Http\Controllers\ROP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ROP as ROPView; 

class ROP extends Controller
{
  public function index()
  {
    $ROP = ROPView::all();

    return view('content.ROP.ROP',compact('ROP'));
  }
}