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

        $id = Auth::guard('client')->id();
		$profilData = Client::find($id);

        return view('client.client_dashboard',compact('profilData'));
    }
    //end Method




    public function ClientLogout(){

        Auth::guard('client')->logout();
        return redirect()->route('client.login')->with('success','Logout Successfully');
    }
    //End Method



    public function ClientProfile(){

        $id = Auth::guard('client')->id();
        $profileData = Client::find($id);
        return view('client.client_profile',compact('profileData'));
    }
    // End Method



    public function ClientProfileStore(Request $request){


            $id = Auth::guard('client')->id();
            $data = Client::find($id);
    
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
    
            $oldPhotopath = $data->photo;
    
            if ($request->hasFile('photo')) {
                # code...
                $file = $request->file('photo');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/admin_images'),$filename);
                $data->photo =$filename;
            }
            if ($oldPhotopath && $oldPhotopath !== $filename) {
                # code...
                //Private function
                $this->deleteOldImage($oldPhotopath);
            }
            $data->save();
    
            $notification = array(
    
                'message' => 'Profile Upadted Successfully',
                'alert-type' => 'suucess'
            );
    
            return redirect()->back()->with($notification); 
    
        }
    //End Method



    private function deleteOldImage(string $oldPhotopath): void{
        // to remove old image from files
    $fullPath = public_path('upload/admin_images/'.$oldPhotopath);

    if (file_exists($fullPath)) {
        unlink($fullPath);
        # code...
    }
}
//End Private Method



public function ClinetChangePassword(){

    $id = Auth::guard('client')->id();
    $profileData = Client::find($id);

    return view('client.reset_password',compact('profileData'));
}
//End Method



public function ClientUpdatePasswordSubmit(Request $request){


    $client = Auth::guard('client')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);

        // To Check if the old password is matche!
        if (!Hash::check($request->old_password, $client->password)) {

            $notification = array(
                'message' => 'Password Dose Not Matche!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // To Update password and saved with encryption
        Client::whereId($client->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
}

}
