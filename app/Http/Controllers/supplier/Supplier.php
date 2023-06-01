<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier as SupplierDB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Supplier extends Controller
{

  public function index()
  {
    $Suppliers = SupplierDB::select('supplier.*')
    ->where('supplier.status', '=', 'ACTIVE')
    ->paginate(5);
    return view('content.Supplier.Supplier',compact('Suppliers'));
  }

  
  public function create()
  {
    return view('content.supplier.create');
  }

  public function edit($id)
  {

    $supplier = SupplierDB::find($id);

    if ($supplier == null) {
      Session::flash('error', 'Supplier Not Found');
      return redirect('supplier');
    }

    // dd($user -> toArray());
    // die();
    return view('content.supplier.edit', compact('supplier'));
  }


  public function update(Request $request, $supplierId)
  {

    try {
      $request->validate([
        'name' => 'required',
        'Address' => 'required',
        'phoneNumber' => 'required',
      ]);
     
      $supplier = SupplierDB::find($supplierId);
      //dd($supplier->toArray());
      $supplier->Name = $request->name;
      $supplier->Address = $request->Address;
      $supplier->PhoneNumber = $request->phoneNumber;
      $supplier->BankName = $request->BankName;
      $supplier->AccountName = $request->AccountName;
      $supplier->AccountNumber = $request->AccountNumber;
      $supplier->save();

      Session::flash('success', 'Supplier Succefully Updated!');
      return redirect()->route('supplier');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }



  public function store(Request $request)
  {

    // dd($request->toArray());

    $request->validate([
      'name' => 'required',
      'Address' => 'required',
      'phoneNumber' => 'required',
    ]);


    try {
      $emailUser = Auth::user()->EmailAddress;
  
      $supplier = new SupplierDB;

      $supplier->Name = $request->name;
      $supplier->Address = $request->Address;
      $supplier->PhoneNumber = $request->phoneNumber;
      $supplier->Status = 'ACTIVE';
      $supplier->BankName = $request->BankName;
      $supplier->AccountName = $request->AccountName;
      $supplier->AccountNumber = $request->AccountNumber;
      $supplier->CreatedBy = $emailUser;
      $supplier->CreatedDate = Carbon::now();
  
      $supplier->save();
      Session::flash('success','Supplier Succefully Added!'); 

      return redirect()->route('supplier');
    
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' =>  $e->getMessage(),
      ]);
    }

  }
  
  public function delete($supplierId)
  {

    try {
      $supplier = SupplierDB::find($supplierId);

      $supplier->status = "DEACTIVED";
      $supplier->save();
      Session::flash('success', 'Supplier Succefully Deleted!');
      return redirect()->route('supplier');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }
  }
}