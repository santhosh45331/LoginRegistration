<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'home'
        ]);
    }

    /**
     * Display a registration form.
     */

    public function register()
    {
        return view('employee.registration');
    }

    /**
     * Store a new user.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('home')->with('Success','You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     */

    public function login()
    {
        return view('employee.login');
    }

    /**
     * Authenticate the user.
     */

    public function authenticate(UserRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('home')->with('Success','You have successfully logged in!');
        }

        return back()->with('error','Your provided credentials do not match in our records.');

    } 
    
    /**
     * Display a dashboard to authenticated users.
     */

    public function home()
    {
        //if(Auth::check())
        //{
            return view('employee.home');
        //}
        
        //return redirect()->route('login')->with('error','Please login to access home page');
    } 
    
    /**
     * Log out the user from application.
     */
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('Success','logged out successfully!');;
    } 
}
