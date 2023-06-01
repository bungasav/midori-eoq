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
      ->where('users.status', '=', 'ACTIVE')
      ->paginate(5);
    return view('content.user.user', compact('users'));
  }


  public function create()
  {
    return view('content.user.create');
  }


  public function edit($id)
  {

    $user = UserDB::find($id);
    if ($user == null) {
      Session::flash('error', 'User Not Found');
      return redirect('user');
    }

    // dd($user -> toArray());
    // die();
    return view('content.user.edit', compact('user'));
  }


  public function update(Request $request, $userId)
  {

    try {
      $request->validate([
        'email' => 'required|email',
        'name' => 'required',
        'role' => 'required',
        'phoneNumber' => 'required',
      ]);
      $user = UserDB::find($userId);

      $user->EmailAddress = $request->email;
      $user->RoleId = $request->role;
      $user->Name = $request->name;
      $user->PhoneNumber = $request->phoneNumber;
      $user->save();

      Session::flash('success', 'User Succefully Updated!');
      return redirect()->route('user');
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
      Session::flash('success', 'User Succefully Added!');
      return redirect()->route('user');

    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
      ]);
    }

  }


  public function delete($userId)
  {

    try {
      $user = UserDB::find($userId);

      $user->status = "DEACTIVED";
      $user->save();
      Session::flash('success', 'User Succefully Deleted!');
      return redirect()->route('user');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => $e->getMessage(),
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