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

    Route::get('role/', 'PermissionSystemController@role_index');
    //  ->middleware('permission:View Role');

    Route::get('role/create', 'PermissionSystemController@role_create');
    //  ->middleware('permission:Register Role');

    Route::post('role/', 'PermissionSystemController@role_store');
    //  ->middleware('permission:Register Role');

    Route::get('role/permissions/{id}', 'PermissionSystemController@role_permissions');
    //  ->middleware('permission:View Role Permissions');

    Route::get('role/permissions/{id}/edit', 'PermissionSystemController@role_permissions_edit');
    //  ->middleware('permission:Edit Role');

    Route::put('role/permissions/{id}', 'PermissionSystemController@role_permissions_update');
    //  ->middleware('permission:Edit Role');

    Route::delete('role/{role_id}/permission/{permission_id}', 'PermissionSystemController@role_permission_delete');
    //  ->middleware('permission:Revoke Permission');

    Route::delete('role/{id}', 'PermissionSystemController@role_delete');
    //  ->middleware('permission:Delete Role');

    /**
     * Assign Role to User
     *
     */
    Route::get('user/roles/', 'PermissionSystemController@user_roles_index');
    //  ->middleware('permission:View Assigned Roles');

    Route::get('user/{id}/roles/', 'PermissionSystemController@user_assigned_roles');
    //  ->middleware('permission:View Assigned Roles');

    Route::get('user/roles/create', 'PermissionSystemController@user_roles_create');
    //  ->middleware('permission:Assign Role');

    Route::post('user/roles/', 'PermissionSystemController@user_roles_store');
    //  ->middleware('permission:Assign Role');

    Route::post('user/{staff_id}/role/{role_id}', 'PermissionSystemController@user_roles_delete');
    //  ->middleware('permission:Revoke Role');

    // Portal Users
    Route::get('portal/user/', 'PortalUserController@index');
    //  ->middleware('permission:View Portal User');
    Route::get('portal/user/create', 'PortalUserController@create');
    //  ->middleware('permission:Register Portal User');
    Route::post('portal/user/', 'PortalUserController@store');
    //  ->middleware('permission:Register Portal User');
    Route::get('portal/user/{id}/edit', 'PortalUserController@edit');
    //  ->middleware('permission:Update Portal User');
    Route::put('portal/user/{id}', 'PortalUserController@update');
    //  ->middleware('permission:Update Portal User');
    Route::delete('portal/user/{id}', 'PortalUserController@destroy');
    //  ->middleware('permission:Disable Portal User');
    Route::get('portal/user/password/{id}', 'PortalUserController@reset_password');
    //  ->middleware('permission:Reset Portal User Password');

    /**
     *  Sizes
     * 
     */
    Route::get('sizes', 'SizesController@index');
    Route::post('sizes', 'SizesController@store');
    Route::get('size/{id}/edit', 'SizesController@edit');
    Route::put('sizes/{id}', 'SizesController@update');
    Route::delete('sizes/{id}', 'SizesController@destroy');

    /**
     *  Flavours
     * 
     */
    Route::get('flavours', 'FlavourController@index');
    Route::get('get_flavours', 'FlavourController@get_dataTable');
    Route::post('flavours', 'FlavourController@store');
    Route::get('flavour/{id}/edit', 'FlavourController@edit');
    Route::put('flavour/{id}', 'FlavourController@update');
    Route::delete('flavour/{id}', 'FlavourController@destroy');




    /**
     *  Trash Bin Routes
     * 
     */

    // Size
    Route::get('sizes/trash', 'TrashBinController@get_size_trash');
    Route::get('size/{id}/restore', 'TrashBinController@restore_size');
    Route::get('size/{id}/delete', 'TrashBinController@delete_size');

    // Flavours
    Route::get('flavours/trash', 'TrashBinController@get_flavour_trash');
    Route::get('flavour/{id}/restore', 'TrashBinController@restore_flavour');
    Route::get('flavour/{id}/delete', 'TrashBinController@delete_flavour');

    // Auth check ends here
});
