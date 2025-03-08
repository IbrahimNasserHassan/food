<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use App\Models\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;



class ClientController extends Controller
{
    //
    public function ClientLogin(){

        return view('client.client_login');

    }
    // End Method


    public function ClientRegister(){

        return view('client.client_register');

    }
    // End Method



    public function ClientRegisterSubmit(Request $request){

        $request->validate([
            'name' => ['required','string','max:200'],
            'email' => ['required','string','unique:clients'],

        ]);

        Client::insert([

            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'password'=> Hash::make($request->password),
            'role'=>'client',
            'status'=>'0',
        ]);

        $notification = array(

            'message' => 'Client Registerd Successfully',
            'alert-type' => 'suucess'
        );

        return redirect()->route('client.login')->with('success','Registerd successfuly');

    }
    // End Method




    public function ClientLoginSubmit(Request $request){

        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required', 
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if (Auth::guard('client')->attempt($data)) {
            return redirect()->route('client.Dashboard')->with('success','Login Successfully');
            # code...
        }else{
            return redirect()->route('client.login')->with('error','Invalid login');
        }

    }
    //End Method




    public function ClientDashboard(){

        return view('client.client_dashboard');
    }
    //end Method
}
