<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Production;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Order as OrderDB;
use App\Models\OrderDetail as OrderDetailDB;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
    $suppliers = Supplier::where('supplier.status', '=', 'ACTIVE')
    ->get();
    $products = Item::where([['type', '=', 'material'], ['item.status', '=', 'ACTIVE']])
    ->get();

    return view('content.Order.create',compact(['suppliers','products']));
  }


  public function store(Request $request)
  {
      DB::beginTransaction();
    try {
      $user = Auth::user();

      $projectCount = OrderDB::count();
      $projectCount++;
      $total = 0;
      foreach ($request['item'] as $it) {
        $total += (int)$it['quantity'] * (float)$it['basePrice'];
      }
      $order = new OrderDB;

      $order->UserId = $user->UserId;
      $order->OrderReference = '#O-MIDORI'. str_pad($projectCount, 5, '0', STR_PAD_LEFT);;
      $order->Status = 'PENDING';
      $order->TotalAmount = $total;
      $order->SupplierId = $request->supplier;
      $order->OrderDate = Carbon::now();

      $order->save();
      $orderId = $order->OrderId;
    
      $itemList = [];
      foreach ($request['item'] as $it) {
        $data = [
          'OrderId' => $orderId,
          'ItemId' => $it['id'],
          'Quantity' => (int)$it['quantity'],
          'BasePrice' => (float)$it['basePrice'],
          'Status' => 'ACTIVE'
        ];
        array_push($itemList, $data);
      }
      OrderDetailDB::insert($itemList);

      DB::commit();
      Session::flash('success','Item Succefully Added!'); 

      return redirect()->route('order');
    
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors([
        'error' =>  $e->getMessage(),
      ]);
    }

    return view('content.Order.create',compact(['suppliers','products']));
  }
  
  public function edit($id)
  {
    $order = OrderDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'order.SupplierId')
    ->select('order.*', 'supplier.Name')
    ->find($id);

    $orderDetails = OrderDetailDB::leftJoin('item', 'item.ItemId', '=', 'orderdetail.ItemId')
    ->where('orderdetail.OrderId', '=', $id)
    ->select('orderdetail.*', 'item.Name as ProductName')
    ->get();
    //;

    if ($order == null) {
      Session::flash('error', 'Order Not Found');
      return redirect('order');
    }

    // dd($user -> toArray());
    // die();
    return view('content.order.edit', compact(['order', 'orderDetails']));
  }
}