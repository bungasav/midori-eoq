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
    ->where([['type', '=', 'product'], ['item.status', '=', 'ACTIVE']])
    ->select('item.*','supplier.Name as SupplierName')
    ->paginate(10);

    return view('content.Product.Product',compact('Products'));
  }

  public function create()
  {
    return view('content.product.create');
  }

  
  public function edit($id)
  {

    $item = ItemDB::find($id);

    if ($item == null) {
      Session::flash('error', 'Item Not Found');
      return redirect('product');
    }

    // dd($user -> toArray());
    // die();
    return view('content.product.edit', compact('item'));
  }


  public function update(Request $request, $itemId)
  {

    try {
      $request->validate([
        'name' => 'required',
        'measurement' => 'required',
        'stock'=> 'required'
      ]);
     
      $item = ItemDB::find($itemId);
      //dd($item->toArray());
      $item->Name = $request->name;
      $item->UnitInStock = $request->stock;
      $item->Description = $request->description;
      $item->UnitOfMeasurement = $request->measurement;
      $item->save();

      Session::flash('success', 'Item Succefully Updated!');
      return redirect()->route('product');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }



  public function store(Request $request)
  {

    $request->validate([
      'name' => 'required',
      'stock'=> 'required',
      'measurement' => 'required',
    ]);


    try {
      $user = Auth::user();
  
      $item = new ItemDB;

      $item->Name = $request->name;
      $item->UserId = $user->UserId;
      $item->Description = $request->description;
      $item->Status = 'ACTIVE';
      $item->UnitInStock = $request->stock;
      $item->Type = "product";
      $item->UnitOfMeasurement = $request->measurement;
      $item->CreatedDate = Carbon::now();
  
      $item->save();
      Session::flash('success','Item Succefully Added!'); 

      return redirect()->route('product');
    
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' =>  $e->getMessage(),
      ]);
    }

  }

  public function delete($itemId)
  {

    try {
      $item = ItemDB::find($itemId);

      $item->status = "DEACTIVED";
      $item->save();
      Session::flash('success', 'Item Succefully Deleted!');
      return redirect()->route('product');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }
}