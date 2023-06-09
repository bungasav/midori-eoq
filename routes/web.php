<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$controller_path = 'App\Http\Controllers';


Route::middleware('guest')->group(function () {
    $controller_path = 'App\Http\Controllers';
    Route::get('/auth/login', $controller_path . '\authentications\LoginBasic@index')->name('login');
    Route::post('/auth/login', $controller_path . '\authentications\LoginBasic@submitLogin')->name('login-action');
});

Route::middleware(['auth','permissions'])->group(function () {
    $controller_path = 'App\Http\Controllers';
    //USER
    Route::get('/user', $controller_path . '\user\User@index')->name('user');
    Route::get('/user/create', $controller_path . '\user\User@create')->name('user-create');
    Route::post('/user/store', $controller_path . '\user\User@store')->name('user-store');
    Route::get('/user/{id}/edit', $controller_path . '\user\User@edit')->name('user-edit');
    Route::put('/user/{id}', $controller_path . '\user\User@update')->name('user-update');
    Route::delete('/user/{id}/delete', $controller_path . '\user\User@delete')->name('user-delete');

    // Route::get('/role', $controller_path . '\user\User@create`')->name('role-tess');
    Route::get('/role', $controller_path . '\user\User@getRole')->name('user-role');

    //SUPPLIER
    Route::get('/supplier', $controller_path . '\supplier\Supplier@index')->name('supplier');
    Route::get('/supplier/create', $controller_path . '\supplier\Supplier@create')->name('supplier-create');
    Route::post('/supplier/store', $controller_path . '\supplier\Supplier@store')->name('supplier-store');
    Route::get('/supplier/{id}/edit', $controller_path . '\supplier\Supplier@edit')->name('supplier-edit');
    Route::put('/supplier/{id}', $controller_path . '\supplier\Supplier@update')->name('supplier-update');
    Route::delete('/supplier/{id}/delete', $controller_path . '\supplier\Supplier@delete')->name('supplier-delete');

    //ITEM
    Route::get('/item', $controller_path . '\item\Item@index')->name('item');
    Route::get('/item/create', $controller_path . '\item\Item@create')->name('item-create');
    Route::post('/item/store', $controller_path . '\item\Item@store')->name('item-store');
    Route::get('/item/{id}/edit', $controller_path . '\item\Item@edit')->name('item-edit');
    Route::put('/item/{id}', $controller_path . '\item\Item@update')->name('item-update');
    Route::delete('/item/{id}/delete', $controller_path . '\item\Item@delete')->name('item-delete');

    //ORDER
    Route::get('/order', $controller_path . '\order\OrderList@index')->name('order');
    Route::get('/order/create', $controller_path . '\order\OrderList@create')->name('order-create');
    Route::post('/order/store', $controller_path . '\order\OrderList@store')->name('order-store');
    Route::get('/order/{id}/edit', $controller_path . '\order\OrderList@edit')->name('order-edit');

    //PRODUCT
    Route::get('/product', $controller_path . '\product\Product@index')->name('product');
    Route::get('/product/create', $controller_path . '\product\Product@create')->name('product-create');
    Route::post('/product/store', $controller_path . '\product\Product@store')->name('product-store');
    Route::get('/product/{id}/edit', $controller_path . '\product\Product@edit')->name('product-edit');
    Route::put('/product/{id}', $controller_path . '\product\Product@update')->name('product-update');
    Route::delete('/product/{id}/delete', $controller_path . '\product\Product@delete')->name('product-delete');

    //ORDER APPROVAL
    Route::get('/approval', $controller_path . '\order\Approval@index')->name('approval');
    Route::post('/approval/{id}/approve', $controller_path . '\order\Approval@approve')->name('approval-approve');
    Route::post('/approval/{id}/rejected', $controller_path . '\order\Approval@rejected')->name('approval-rejected');

    //PRODUCTION
    Route::get('/production', $controller_path . '\production\ProductionList@index')->name('production');
    Route::get('/production/create', $controller_path . '\production\ProductionList@create')->name('production-create');
    Route::post('/production/store', $controller_path . '\production\ProductionList@store')->name('production-store');
    Route::get('/production/{id}/edit', $controller_path . '\production\ProductionList@edit')->name('production-edit');

    //OTHER
    Route::get('/eoq', $controller_path . '\eoq\EOQ@index')->name('eoq');
    Route::get('/rop', $controller_path . '\rop\ROP@index')->name('rop');
});

Route::middleware(['auth'])->group(function () {
    $controller_path = 'App\Http\Controllers';
    //USER
    Route::get('/', $controller_path . '\home\Home@index')->name('home');
    Route::get('/role', $controller_path . '\user\User@getRole')->name('user-role');
    Route::get('/auth/logout', $controller_path . '\authentications\LoginBasic@logout')->name('user-logout');

});


// Main Page Route
Route::get('/template', $controller_path . '\dashboard\Analytics@index')->name('dashboard');

// Route::get('/auth/login', $controller_path . '\authentications\LoginBasic@index')->name('login');
// Route::post('/auth/login', $controller_path . '\authentications\LoginBasic@submitLogin')->name('login-action');


// // layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// // pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// User Interface
Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');
