<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item as ItemDB; 

class Item extends Controller
{

  public function index()
  {
    $Items = ItemDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'item.SupplierId')
    ->select('item.*','supplier.Name as SupplierName')
    ->get();

    return view('content.Item.Item',compact('Items'));
  }
}