<?php

namespace App\Providers;

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
      $permission = new Permission;
      $permissionList = $permission->getPermissionByRoleId($user->RoleId);

      $view->with('user', $user)->with('permissionList', $permissionList);
    });
  }
}