<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;

     public function __construct() {
        //Login Page can be viewd by anyone 

        $this->user = new user();

     }

    public function index()
    {

        // if session then dashboard 
        //else login page
        if(Auth::guard('admin')->check())
        {

           return redirect("dashboard");

        }
        else
        {
            $title='Admin Login';
            return view('login.login',compact('title'));

        }
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = ["email" => $request->email, "password" => ($request->password)];
       
       //Check For Valid Admin and Authenticate
        if(Auth::guard('admin')->validate($credentials, false)) {
            //Authenticate (Create and Save Token)
            $this->authenticate($credentials);
            $data=User::where('email',$request->email)->first();
            //Welcome Back, Admin!
            session()->flash("Success", "Welcome Back " . $data->fname);

            //Redirect To Dashboard //Success
            return redirect("dashboard");
        }
        //Error
        return back()->withErrors(['message' => 'Username or Password didnot matched']);
    }

    public function authenticate($credentials) {
        //Retrieve Admin using Credentials
        $admin = Auth::guard("admin")->getProvider()->retrieveByCredentials($credentials);
        //Authorize Admin (generate and put token under cookie)
        Auth::guard("admin")->login($admin, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
       
        
    }

    public function logout()
    {
        
         Auth::guard('admin')->logout();
         return redirect('login');
    }
}
