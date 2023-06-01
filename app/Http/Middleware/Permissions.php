<?php

namespace App\Http\Middleware;

use App\Permissions\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Route;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roleId = Auth::user()->RoleId;
        $permission = new Permission;
        $permissionList = $permission->getPermissionByRoleId($roleId);
        $currentRoute = Route::getCurrentRoute()->getName();
        if (in_array($currentRoute, $permissionList)) {
            return $next($request);

        } else {
            abort(403);

        }

    }
}