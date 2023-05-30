<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserDB;
use App\Models\Role as RoleDB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class User extends Controller
{

  public function index()
  {
    $users = UserDB::leftJoin('role', 'role.RoleId', '=', 'users.RoleId')
      ->select('users.*', 'role.Name')
      ->paginate(5);
    return view('content.user.user', compact('users'));
  }


  public function create()
  {
    return view('content.user.create');
  }

  public function create_action(Request $request)
  {

    // dd($request->toArray());

    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
      'name' => 'required',
      'role' => 'required',
      'phoneNumber' => 'required',
    ]);


    try {

      $user = new UserDB;

      $user->EmailAddress = $request->email;
      $user->RoleId = $request->role;
      $user->Name = $request->name;
      $user->Status = 'ACTIVE';
      $user->PhoneNumber = $request->phoneNumber;
      $user->PasswordHash = Hash::make($request->password);
      $user->CreatedDate = Carbon::now();
  
      $user->save();
      Session::flash('success','User Succefully Added!'); 

      return redirect()->route('user');
    
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' =>  $e->getMessage(),
      ]);
    }

  }

  public function getRole()
  {
    $role = RoleDB::all();
    return response()->json(
      $role
    );
  }
}