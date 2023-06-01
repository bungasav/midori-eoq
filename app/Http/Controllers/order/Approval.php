<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order as OrderDB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\OrderDetail as OrderDetailDB;
use App\Models\Item;
use DB;

class Approval extends Controller
{
  public function index()
  {
    $Orders = OrderDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'order.SupplierId')
    ->leftJoin('users', 'users.UserId', '=', 'order.UserId')
    ->select('order.*','supplier.Name as SupplierName', 'users.Name as UserName')
    ->paginate(10);

    return view('content.Approval.Approval',compact('Orders'));
  }
  
  public function approve($id)
  {

    DB::beginTransaction();
    try {
      $item = OrderDB::find($id);
      $item->status = "APPROVED";
      $item->save();
      
      $items = OrderDetailDB::leftJoin('item', 'item.ItemId', '=', 'orderdetail.ItemId')
      ->where('orderdetail.OrderId', '=', $id)
      ->select('item.*', 'orderdetail.Quantity')
      ->get();

      //$itemList = [];
      foreach ($items as $it) {
        $stock = $it->UnitInStock + $it->Quantity;
        // $data = [
        //   'UnitInStock' => $stock,
        //   'ItemId' => $it['ItemId']
        // ];
        // array_push($itemList, $data);
        DB::table('item')
            ->where('ItemId', $it['ItemId'])
            ->update(['UnitInStock' => $stock]);
      }
      //dd($itemList);
      //Item::update($itemList);
      DB::commit();

      Session::flash('success', 'Order Succefully Approved!');
      return redirect()->route('approval');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }

  public function rejected($id)
  {
    try {
      $item = OrderDB::find($id);

      $item->status = "REJECTED";
      $item->save();
      Session::flash('success', 'Order Succefully Rejected!');
      return redirect()->route('approval');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }
}