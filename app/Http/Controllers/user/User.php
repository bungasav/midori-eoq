<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserDB; 

class User extends Controller
{

  public function index()
  {

    $users =  UserDB::leftJoin('role', 'role.RoleId', '=', 'users.RoleId')
    ->select('users.*','role.Name')
    ->get();
// dd(  $users );
    return view('content.user.user',compact('users'));
  }
}