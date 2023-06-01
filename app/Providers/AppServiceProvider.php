<?php

namespace App\Providers;

use App\Models\User;
use App\Permissions\Permission;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //


  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //

    view()->composer('*', function ($view) {

      $user = Auth::user();
      if (Auth::check()) {
        $userData = User::leftJoin('role', 'role.RoleId', '=', 'users.RoleId')
          ->select('users.*', 'role.Name as RoleName')
          ->where('users.UserId', '=', $user->UserId)
          ->first();
          
        $permission = new Permission;
        $permissionList = $permission->getPermissionByRoleId($user->RoleId);
        $view->with('user', $userData)->with('permissionList', $permissionList);

      } else {
        $view->with('user', $user)->with('permissionList', []);
      }
    });
  }
}