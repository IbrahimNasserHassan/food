<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //Theme function
    public function index()
    {
        // if(view()->exists($id)){
        //     return view($id);
        // }
        // else
        // {
        //     return view('404');
        // }

    return view('index');
    }
    //End Method





    public function AdminLogin(){

        return view('admin.login');

    }

    //End Method




    public function AdminDashboard(){
        
		$id = Auth::guard('admin')->id();
		$profilData = Admin::find($id);

        return view('admin.dashboard',compact('profilData'));
    }

    //End Method




    public function AdminLoginSubmit(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required', 
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password']
        ];
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.Dashboard')->with('success','Login Successfully');
            
        }else{

            return redirect()->route('admin.login')->with('error','Invalid Login');
        }

    }
    //End Method




    public function AdminLogout(){

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','Logout Successfully');
    }
    //End Method




    public function AdminForgetPssowrd(){

        return view('admin.forget_password');
    }
    //End Method




    public function AdminPasswordSubmit(Request $request){

        $request->validate([
            'email'=>'required|email'
        ]);

        $admin_data = Admin::where('email',$request->email)->first();
        if (!$admin_data) {

            return redirect()->back()->with('error','This Email is not found');

        }
        $token = hash('sha256',time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = "Reset Password";
        $message = "Pleas Click here to reset password <br>";
        $message .= "<a href='".$reset_link."'> Click Here</a>";

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Reset Link Send on your Password');

    }
    //End Method




    public function AdminResetPassword($token,$email){

        $admin_data = Admin::where('email',$email)->where('token',$token)->first();

        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error','Invalid Token or Email');
            # code...
        }
        return view('admin.reset_password',compact('token','email'));

    }
    //End Method




    public function AdminResetPasswordSubmit(Request $request){

        $request->validate([
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
        ]);

        $admin_data = Admin::where('email',$request->email)->where('token',$request->token)->first();
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = "";
        $admin_data->update();

        return redirect()->route('admin.login')->with('success','Password Reset Successfully');
    }
    //End Method





    public function AdminProfile(){
        
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_profile',compact('profileData'));

    }
    //End Method




    public function AdminProfileStore(Request $request){

        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);

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




    public function AdminChangePassword(){
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);

        return view('admin.admin_change_password',compact('profileData'));
    }
    //End Method



    public function AdminPasswordUpdate(Request $request){

        $admin = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);

        // To Check if the old password is matche!
        if (!Hash::check($request->old_password, $admin->password)) {
            $notification = array(

                'message' => 'Password Dose Not Matche!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // To Update password and saved with encrypt
        Admin::whereId($admin->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }
    //End Method





    



}
