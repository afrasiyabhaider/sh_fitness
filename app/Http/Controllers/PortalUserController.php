<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PortalUserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();
        $users = User::where('id', '!=', $auth_user->id)->latest()->get();

        return view('portal_users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portal_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'image|mimes:jpg,jpeg,png',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'conf_pass' => 'required|same:password',
            'phone_number' => 'required|min:9|max:20',
            'address' => 'required|max:150',
            'gender' => 'required',
        ]);

        try {

            DB::beginTransaction();
            $user = new User();
            if ($request->hasFile('image')) {
                $image_file = $request->file('image');
                $image = Storage::disk('media')->put('images/portal_users/', $image_file);

                $user->image = $image;
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->phone_number = $request->input('phone_number');
            $user->address = $request->input('address');
            $user->gender = $request->input('gender');

            $user->save();

            DB::commit();

            alert()->success('User Registered', 'Portal user is registered successfully. Now assign any role to this user');
            return redirect(url('portal/user'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            alert()->error('User not Registered', 'Please try again');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = decrypt($id);
        $user = User::find($user_id);
        // dd($user);

        return view('portal_users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'file' => 'image|mimes:jpg,jpeg,png',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|min:9|max:20',
            'address' => 'required|max:150',
            'gender' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image = Storage::disk('media')->put('images/portal_users/', $image_file);

            $user->image = $image;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');

        $user->save();

        alert()->success('User Updated', 'Portal user is updated successfully');
        return redirect(url('portal/user/'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::find($id);
            $user->delete();

            DB::commit();
            alert()->success('User Disabled', 'Portal user is Disabled successfully. Go to Trash bin > Portal Users to enable this user');
            return redirect(url('portal/user/'));
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('User not Disabled', 'Please try again');
        }
        return redirect()->back();
    }

    /**
     *  Reset Password
     * 
     */
    public function reset_password($id)
    {
        try {
            DB::beginTransaction();

            $user_id = decrypt($id);
            $user = User::find($user_id);

            $user->password = Hash::make(12345678);

            $user->save();

            DB::commit();
            alert()->success('Password Reseted', 'Portal user\'s password is resetted to 12345678');
            return redirect(url('portal/user/'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            alert()->error('Password not Resetted', 'Please try again');
        }
        return redirect()->back();
    }

    
    /**
     * Logged in Staff's Profile
     *
     */

    public function profile()
    {
        $user = Auth::user();
        // dd($staff);
        return view('staffs.profile',compact('user'));
    }

    /**
     * Change Password of Staff
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        $this->change_password_form($request);
        $user = User::find($id);
        $old_password = $request->input('old_password');
        $checkPass = Hash::check($old_password, $user->password);
        if (!$checkPass) {
            alert()->error('Password Not Match', 'Old Password didn\'t matched with our record. Please enter the correct password to proceed');
            return redirect()->back();
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        alert()->success('Password Changed', 'Password changed successfully please login with new password');
        Auth::logout();
        return redirect(url('login/'));
    }

    /**
     * Form Validations
     *
     */
    public function change_password_form($request)
    {
        $message = [
            'regex' => 'Password Must be Between 4-14 Charaters Long, Must Contain 1 Upper Case, 1 Special Character and 1 Numeric'
        ];
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:4|max:14|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{4,14}$/|different:old_password',
            'reenter_password' => 'required|same:new_password',
        ];
        $this->validate($request, $rules, $message);
    }
}
