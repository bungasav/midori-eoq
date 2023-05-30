<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order as OrderDB; 

class OrderList extends Controller
{
  public function index()
  {
    $Orders = OrderDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'order.SupplierId')
    ->leftJoin('users', 'users.UserId', '=', 'order.UserId')
    ->select('order.*','supplier.Name as SupplierName', 'users.Name as UserName')
    ->paginate(10);

    return view('content.Order.Order',compact('Orders'));
  }
}