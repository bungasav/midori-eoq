<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item as ItemDB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Product extends Controller
{

  public function index()
  {
    $Products = ItemDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'item.SupplierId')
    ->where('type', '=', 'product')
    ->select('item.*','supplier.Name as SupplierName')
    ->paginate(10);

    return view('content.Product.Product',compact('Products'));
  }
}