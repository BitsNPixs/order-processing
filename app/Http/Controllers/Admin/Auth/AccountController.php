<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Show admin login screen
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getLogin()
    {
        return view("admin.login");
    }

    /**
     * Handel admin login post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            "username.required" => "Username is required",
            "password.required" => "Password is required"
        ]);

        $attemptLogin = Auth::guard('admin')->attempt(['username' => $data["username"], 'password' => $data["password"], 'status' => 1], true);

        if ($attemptLogin) {
            Admin::where('username', $data["username"])->update(['fail_attempt' => 0]);

            return redirect()->intended(route('adminOrders'));
        }
        else{
            $admin = Admin::where("username", $data["username"])->first();
            if ($admin != null){
                $admin->increment('fail_attempt');
                if ($admin->fail_attempt == 5){
                    $admin->status = 0;
                    $admin->save();
                    $msg = 'You account suspended. Contact administrator.';
                }
                elseif ($admin->fail_attempt > 5)
                    $msg = 'You account suspended. Contact administrator.';
                else{
                    $msg = sprintf("Invalid login credentials.\r\n Attempt remaining %s", 5 - $admin->fail_attempt);
                }
            }
            else
                $msg = 'Invalid login credentials';

            return redirect()->back()->withInput()->withErrors($msg);
        }
    }

    /**
     * Logout admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route("admin.login");
    }

    /**
     * Show admin password update screen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getUpdatePassword()
    {
        return view("admin.updatePassword");
    }

    /**
     * Handel admin update password post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdatePassword(Request $request)
    {
        $data = $request->validate([
            "password" => "bail|required|confirmed",
            "password_confirmation" => "required"
        ]);

        $admin = Admin::find(Auth::user()->id);

        if ($admin) {
            $admin->update(["password" => Hash::make($data["password"])]);
            return redirect()->back()->with("message", "Password update successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Unexpected error. Contact webmaster");
        }

    }
}
