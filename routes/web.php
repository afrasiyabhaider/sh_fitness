<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect(url('login'));
});
// Route::get('{any}', function () {
//     return view('home');
// })->where('any', '.*');

Auth::routes(['register' => false]);

Route::group(['auth'], function () {
    //  Dashboard
    Route::get('portal/dashboard', 'HomeController@index')->name('home');


    /**
     *  Permission System
     * 
     */
    Route::get('permission/', 'PermissionSystemController@permissions_index');
    Route::get('permission/create/', 'PermissionSystemController@permissions_create');

    Route::get('role/', 'PermissionSystemController@role_index')->middleware('permission:View Roles');

    Route::get('role/create', 'PermissionSystemController@role_create')->middleware('permission:Register Role');

    Route::post('role/', 'PermissionSystemController@role_store')->middleware('permission:Register Role');

    Route::get('role/permissions/{id}', 'PermissionSystemController@role_permissions')->middleware('permission:View Role Permissions');

    Route::get('role/permissions/{id}/edit', 'PermissionSystemController@role_permissions_edit')->middleware('permission:Edit Role');

    Route::put('role/permissions/{id}', 'PermissionSystemController@role_permissions_update')->middleware('permission:Edit Role');

    Route::delete('role/{role_id}/permission/{permission_id}', 'PermissionSystemController@role_permission_delete')->middleware('permission:Revoke Permission');

    Route::delete('role/{id}', 'PermissionSystemController@role_delete')->middleware('permission:Delete Role');

    /**
     * Assign Role to User
     *
     */
    Route::get('user/roles/', 'PermissionSystemController@user_roles_index')->middleware('permission:View Assigned Roles');

    Route::get('user/{id}/roles/', 'PermissionSystemController@user_assigned_roles')->middleware('permission:View Assigned Roles');

    Route::get('user/roles/create', 'PermissionSystemController@user_roles_create')->middleware('permission:Assign Role');

    Route::post('user/roles/', 'PermissionSystemController@user_roles_store')->middleware('permission:Assign Role');

    Route::post('user/{staff_id}/role/{role_id}', 'PermissionSystemController@user_roles_delete')->middleware('permission:Revoke Role');

    // Portal Users
    Route::get('portal/user/', 'PortalUserController@index')->middleware('permission:View Portal Users');
    Route::get('portal/user/create', 'PortalUserController@create')->middleware('permission:Register Portal User');
    Route::post('portal/user/', 'PortalUserController@store')->middleware('permission:Register Portal User');
    Route::get('portal/user/{id}/edit', 'PortalUserController@edit')->middleware('permission:Edit Portal Users');
    Route::put('portal/user/{id}', 'PortalUserController@update')->middleware('permission:Edit Portal Users');
    Route::delete('portal/user/{id}', 'PortalUserController@destroy')->middleware('permission:Disable Portal Users');
    Route::get('portal/user/password/{id}', 'PortalUserController@reset_password')->middleware('permission:Reset Portal User Password');

    /**
     *  Sizes
     * 
     */
    Route::get('sizes', 'SizesController@index')->middleware('permission:View Sizes');
    Route::post('sizes', 'SizesController@store')->middleware('permission:Register Size');
    Route::get('size/{id}/edit', 'SizesController@edit')->middleware('permission:Edit Size');
    Route::put('sizes/{id}', 'SizesController@update')->middleware('permission:Edit Size');
    Route::delete('sizes/{id}', 'SizesController@destroy')->middleware('permission:Disable Size');

    /**
     *  Flavours
     * 
     */
    Route::get('flavours', 'FlavourController@index')->middleware('permission:View Flavours');
    // Route::get('get_flavours', 'FlavourController@get_dataTable');
    Route::post('flavours', 'FlavourController@store')->middleware('permission:Register Flavour');
    Route::get('flavour/{id}/edit', 'FlavourController@edit')->middleware('permission:Edit Flavour');
    Route::put('flavour/{id}', 'FlavourController@update')->middleware('permission:Edit Flavour');
    Route::delete('flavour/{id}', 'FlavourController@destroy')->middleware('permission:Disable Flavour');
    /**
     *  Flavours
     * 
     */
    Route::get('category', 'CategoryController@index');
    Route::post('category', 'CategoryController@store');
    Route::get('category/{id}/edit', 'CategoryController@edit');
    Route::put('category/{id}', 'CategoryController@update');
    Route::delete('category/{id}', 'CategoryController@destroy');




    /**
     *  Trash Bin Routes
     * 
     */

    // Size Trash
    Route::get('sizes/trash', 'TrashBinController@get_size_trash')->middleware('permission:Enable Size');
    Route::get('size/{id}/restore', 'TrashBinController@restore_size')->middleware('permission:Enable Size');
    Route::get('size/{id}/delete', 'TrashBinController@delete_size')->middleware('permission:Permanent Delete Size');

    // Flavours Trash
    Route::get('flavours/trash', 'TrashBinController@get_flavour_trash')->middleware('permission:Enable Flavour');
    Route::get('flavour/{id}/restore', 'TrashBinController@restore_flavour')->middleware('permission:Enable Flavour');
    Route::get('flavour/{id}/delete', 'TrashBinController@delete_flavour')->middleware('permission:Permanent Delete Flavour');

    // Portal Users Trash
    Route::get('portal_user/trash', 'TrashBinController@get_portal_user_trash')->middleware('permission:Enable Portal Users');
    Route::get('portal_user/{id}/restore', 'TrashBinController@restore_portal_user')->middleware('permission:Enable Portal Users');
    Route::get('portal_user/{id}/delete', 'TrashBinController@delete_portal_user')->middleware('permission:Permanent Delete Portal Users');

    // Categories Trash
    Route::get('category/trash', 'TrashBinController@get_category_trash');
    Route::get('category/{id}/restore', 'TrashBinController@restore_category');
    Route::get('category/{id}/delete', 'TrashBinController@delete_category');

    // Auth check ends here
});




Route::get('permission-reset', function () {
    \Artisan::call('permission:cache-reset');
    dd("Permission Cache Resetted");
});
Route::get('route-clear', function () {
    \Artisan::call('route:clear');
    dd("Route Cleared");
});
Route::get('optimize', function () {
    \Artisan::call('optimize');
    dd("Optimized");
});

