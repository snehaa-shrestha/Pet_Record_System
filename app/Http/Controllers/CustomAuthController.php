<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;   // secures password
use Session;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function registration()
    {
        return view("auth.registration");
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users', // here the unique:users ensures that users do not have same email
            'password'=>'required|min:8|max:12'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if($res){
            return back()->with('success','You have registered successfully.');
        }
        else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email', // here the unique:users ensures that users do not have same email
            'password'=>'required|min:8|max:12'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(hash::check($request->password, $user->password)){    // checks the password provided by the user during login and the password in DB is same or not
                $request->session()->put('loginID', $user->id);
                if($request->email=="admin@admin.com"){
                    return redirect('admindashboard');
                }
                return redirect('userdashboard');
            }
            else{
                return back()->with('fail','Password does not match.');
            }
        }
        else{
            return back()->with('fail','This email is not registered.');
        }
    }

    public function userdashboard(){
        $data = array();
        if(Session::has('loginID')){
            $data = User::where('id', '=', Session::get('loginID'))->first();
        }
        return view('userdashboard', compact('data'));
    }

    public function admindashboard(){
        $data = array();
        if(Session::has('loginID')){
            $data = User::where('id', '=', Session::get('loginID'))->first();

            $user=User::all();
        }
        return view('admindashboard', compact('user'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users', // here the unique:users ensures that users do not have same email
            'password'=>'required|min:8|max:12'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('admindashboard/create')->with('status', 'User has been created.');
    }

    public function edit(int $id){
        $user = User::findOrFail($id);
        //return $user;
        return view('edit', compact('user'));
    }

    public function update(Request $request, int $id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users', // here the unique:users ensures that users do not have same email
            'password'=>'required|min:8|max:12'
        ]);

        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('status', 'User has been updated.');
    }

    public function destroy(int $id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('status', 'User has been deleted.');
    }

    public function logout(){
        if(Session::has('loginID')){
            Session::pull('loginID');
            return redirect('login');
        }
    }
}
