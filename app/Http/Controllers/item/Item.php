<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item as ItemDB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Item extends Controller
{

  public function index()
  {
    $Items = ItemDB::leftJoin('supplier', 'supplier.SupplierId', '=', 'item.SupplierId')
    ->where([['type', '=', 'material'], ['item.status', '=', 'ACTIVE']])
    ->select('item.*','supplier.Name as SupplierName')
    ->paginate(10);

    return view('content.Item.Item',compact('Items'));
  }
  
  public function create()
  {
    return view('content.item.create');
  }

  public function edit($id)
  {

    $item = ItemDB::find($id);

    if ($item == null) {
      Session::flash('error', 'Item Not Found');
      return redirect('item');
    }

    // dd($user -> toArray());
    // die();
    return view('content.item.edit', compact('item'));
  }


  public function update(Request $request, $itemId)
  {

    try {
      $request->validate([
        'name' => 'required',
        'measurement' => 'required',
      ]);
     
      $item = ItemDB::find($itemId);
      //dd($item->toArray());
      $item->Name = $request->name;
      $item->Description = $request->description;
      $item->UnitOfMeasurement = $request->measurement;
      $item->save();

      Session::flash('success', 'Item Succefully Updated!');
      return redirect()->route('item');
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
      'measurement' => 'required',
    ]);


    try {
      $user = Auth::user();
  
      $item = new ItemDB;

      $item->Name = $request->name;
      $item->UserId = $user->UserId;
      $item->Description = $request->description;
      $item->Status = 'ACTIVE';
      $item->UnitInStock = 0;
      $item->Type = "material";
      $item->UnitOfMeasurement = $request->measurement;
      $item->CreatedDate = Carbon::now();
  
      $item->save();
      Session::flash('success','Item Succefully Added!'); 

      return redirect()->route('item');
    
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
      return redirect()->route('item');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }
}