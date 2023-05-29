<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production as ProductionDB; 

class ProductionList extends Controller
{
  public function index()
  {
    $Productions = ProductionDB::leftJoin('users', 'users.UserId', '=', 'production.UserId')
    ->select('production.*', 'users.Name as UserName')
    ->get();

    return view('content.Production.Production',compact('Productions'));
  }
}