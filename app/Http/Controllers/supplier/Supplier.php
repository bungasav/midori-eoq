<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier as SupplierDB; 

class Supplier extends Controller
{

  public function index()
  {
    $Suppliers = SupplierDB::all();
    //return dd($Suppliers);

    return view('content.Supplier.Supplier',compact('Suppliers'));
  }
}