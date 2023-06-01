<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Production;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Order as OrderDB;

class OrderList extends Controller
{
  public function index()
  {
    $Orders = OrderDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'order.SupplierId')
      ->leftJoin('users', 'users.UserId', '=', 'order.UserId')
      ->select('order.*', 'supplier.Name as SupplierName', 'users.Name as UserName')
      ->paginate(10);

    return view('content.Order.Order', compact('Orders'));
  }

  public function create()
  {
    $suppliers = Supplier::all();
    $products = Item::all();

    return view('content.Order.create',compact(['suppliers','products']));
  }


  public function store(Request $request)
  {
  
    dd($request -> toArray());
    die();

    return view('content.Order.create',compact(['suppliers','products']));
  }
}