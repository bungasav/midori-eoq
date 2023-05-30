<?php

namespace App\Http\Controllers\EOQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EOQ as EOQView; 

class EOQ extends Controller
{
  public function index()
  {
    $EOQ = EOQView::all();

    return view('content.EOQ.EOQ',compact('EOQ'));
  }
}