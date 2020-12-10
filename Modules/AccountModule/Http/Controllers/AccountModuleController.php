<?php

namespace Modules\AccountModule\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

// use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;

class AccountModuleController extends Controller
{
    public function index(){
        return view('accountmodule::register');
    }
    public function register(){
            return view('accountmodule::register');
          }
      
    public function storeUser(Request $request)
        {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1
        ]);
           return redirect()->route('home');
        }

    public function login(){
        return view('accountmodule::login');
    }

    public function authenticate(Request $request)
        {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role_id == 0){
                return redirect()->route('admin-layout');
            }
            else{
                return redirect()->route('home');
            }
        }

        return redirect()->route('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function editUserInfor(){
        return view('accountmodule::editUserInfor');
    }

    public function storeEditUserInfor(Request $request){
        User::where('email',Auth::user()->email)
        ->update([
            'name'=>$request->name,
            'phonenumber'=>$request->phonenumber,
            'dateofbirth'=>$request->dateofbirth
        ]);
        Auth::user()->phonenumber = $request->phonenumber;
        Auth::user()->dateofbirth = $request->dateofbirth;
    
        return redirect(route('editUserInfor'))->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function home(){
        return redirect()->route('trang-chu');
    }

    // Cotroller quan ly nguoi dung
    public function all_user(){
        $all_user = DB::table('users')->get();
        $manager_user = view('accountmodule::users')->with('all_user', $all_user);
        return view('admin')->with('all_user', $manager_user); 
    }

    public function changeUserRoleToAdmin($user_id){
        DB::table('users')->where('id', $user_id)->update(['role_id'=>0]);
        Session::put('message','User Role Changed To Admin Successfully !');
        return \redirect()->action([AccountModuleController::class, 'all_user']);
    }
    
    public function cancelAdminRole($user_id){
        DB::table('users')->where('id', $user_id)->update(['role_id'=>1]);
        Session::put('message','Admin Role Canceled !');
        return \redirect()->action([AccountModuleController::class, 'all_user']);
    }

    public function delete_user($user_id){
        DB::table('users')->where('id', $user_id)->delete();
        Session::put('message','Delete User Successfully');
        return \redirect()->action([AccountModuleController::class, 'all_user']);
    }

}


