<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    /**
     * Show user login screen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getLogin()
    {
        return view("login");
    }

    /**
     * Handle user login post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            "email.required" => "email is required",
            "password.required" => "Password is required"
        ]);

        $attemptLogin = Auth::attempt(['email' => $data["email"], 'password' => $data["password"], 'status' => 1], true);

        if ($attemptLogin) {
            User::where('email', $data["email"])->update(['fail_attempt' => 0]);

            return redirect()->intended(route('index'));
        }
        else{
            $user = User::where("email", $data["email"])->first();
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

    /**
     * Logout user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route("login");
    }

    /**
     * Show user update password screen
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getUpdatePassword()
    {
        return view("updatePassword");
    }

    /**
     * Handle user update password post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdatePassword(Request $request)
    {
        $data = $request->validate([
            "password" => "bail|required|confirmed",
            "password_confirmation" => "required"
        ]);

        $user = User::find(Auth::user()->id);

        if ($user) {
            $user->update(["password" => Hash::make($data["password"])]);
            return redirect()->back()->with("message", "Password update successfully");
        } else {
            return redirect()->back()->withInput()->withErrors("Unexpected error. Contact webmaster");
        }

    }
}
