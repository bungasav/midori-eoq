<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production as ProductionDB; 
use App\Models\ProductionDetail; 
use App\Models\Item; 
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProductionList extends Controller
{
  public function index()
  {
    $Productions = ProductionDB::leftJoin('users', 'users.UserId', '=', 'production.UserId')
    ->select('production.*', 'users.Name as UserName')
    ->get();

    return view('content.Production.Production',compact('Productions'));
  }

  public function create()
  {
    $products = Item::where([['type', '=', 'material'], ['item.status', '=', 'ACTIVE']])
    ->get();

    return view('content.Production.create',compact('products'));
  }


  public function store(Request $request)
  {
      DB::beginTransaction();
      try {
      $user = Auth::user();

      $projectCount = ProductionDB::count();
      $projectCount++;
      $production = new ProductionDB;

      $production->UserId = $user->UserId;
      $production->Reference = '#PRODUCTION-'. str_pad($projectCount, 5, '0', STR_PAD_LEFT);;
      $production->Status = 'ACTIVE';
      $production->CreatedDate = Carbon::now();

      $production->save();
      $productionId = $production->ProductionId;
    
      $itemList = [];
      $itemIds = [];
      foreach ($request['item'] as $it) {
        //dd($it);
        $data = [
          'ProductionId' => $productionId,
          'ItemId' => $it['id'],
          'Quantity' => (int)$it['quantity'],
          'Status' => 'ACTIVE',
          'UserId' => $user->UserId,
          'CreatedDate' => Carbon::now()
        ];
        array_push($itemList, $data);
        array_push($itemIds, $it['id']);
      }
      ProductionDetail::insert($itemList);

      $items = Item::whereIn('ItemId', $itemIds)->get();

      foreach ($items as $it) {
        $change = collect($itemList)->where('ItemId', $it['ItemId']);
        $stock = $it->UnitInStock - $change[0]['Quantity'];

        DB::table('item')
            ->where('ItemId', $it['ItemId'])
            ->update(['UnitInStock' => $stock]);
      }

      DB::commit();
      Session::flash('success','Item Succefully Added!'); 

      return redirect()->route('production');
    
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors([
        'error' =>  $e->getMessage(),
      ]);
    }

    return view('content.Production.create',compact('products'));
  }
  
  public function edit($id)
  {
    $production = ProductionDB::find($id);

    $productionDetails = ProductionDetail::leftJoin('item', 'item.ItemId', '=', 'productiondetail.ItemId')
    ->where('productiondetail.ProductionId', '=', $id)
    ->select('productiondetail.*', 'item.Name as ProductName')
    ->get();

    if ($production == null) {
      Session::flash('error', 'Production Not Found');
      return redirect('production');
    }

    // dd($user -> toArray());
    // die();
    return view('content.Production.edit', compact(['production', 'productionDetails']));
  }
}