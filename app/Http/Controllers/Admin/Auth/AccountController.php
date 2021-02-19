<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    public function getLogin()
    {
        return view("login");
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ],[
            "email.required" => "email is required",
            "password.required" => "Password is required"
        ]);

        $attemptLogin = Auth::attempt(['email' => $request->get("email"), 'password' => $request->get("password"), 'status' => 1], true);

        if ($attemptLogin) {
            User::where('email', $request->get("email"))->update(['fail_attempt' => 0]);

            return redirect()->intended(route('index'));
        }
        else{
            $user = User::where("email", $request->get("email"))->first();
            if ($user != null){
                $user->increment('fail_attempt');
                if ($user->fail_attempt == 5){
                    $user->status = 0;
                    $user->save();
                    $msg = 'You account suspended. Contact administrator.';
                }
                elseif ($user->fail_attempt > 5)
                    $msg = 'You account suspended. Contact administrator.';
                else{
                    $msg = sprintf("Invalid login credentials.\r\n Attempt remaining %s", 5 - $user->fail_attempt);
                }
            }
            else
                $msg = 'Invalid login credentials';

            return redirect()->back()->withInput()->withErrors($msg);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route("login");
    }

    public function getUpdatePassword()
    {
        return view("admin.updatePassword");
    }

    public function postUpdatePassword(Request $request)
    {
        $this->validate($request, [
            "password" => "bail|required|confirmed",
            "password_confirmation" => "required"
        ]);
        $user = User::find(Auth::user()->id)->update(["password" => Hash::make($request->get("password"))]);
        if ($user) {
            return redirect()->back()->with("message", "Password update successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Unexpected error. Contact webmaster");
        }

    }
}
