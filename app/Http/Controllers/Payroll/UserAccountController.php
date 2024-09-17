<?php

namespace App\Http\Controllers\Payroll;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class UserAccountController extends Controller
{
    public function userAccountProfile(): View
    {
        return view('payroll.user-account.user-account-profile');
    }

    public function userAccountSettings(): View
    {
        return view('payroll.user-account.user-account-settings');
    }

    public function postUserAccountProfile(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|min:2|max:125',
            'last_name' => 'required|min:2|max:125',
            'mobile' => 'max:11',
            'email' => 'required|email|unique:users,email,'.Auth()->user()->id,
        ]);

        $validatedData = array_merge($validatedData, ['updated_at' => Carbon::now()]);
        
        try {
            User::where('id', Auth::user()->id)
            ->update($validatedData);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('account.profile')->with('error', 'Something went wrong!');
        }
        
        return redirect()->route('account.profile')->with('success', 'Updated successfully!');
    }

    public function postUserAccountSettingsChangePassword(Request $request): RedirectResPonse
    {
        $auth = Auth::user();        
        /** Check current password matches */
        if (!Hash::check($request->input('current_password'), $auth->password)) {
            return redirect()->back()->withInput()->with('errorPasswordNotMatch', 'Current password does not match with the old password!');
        }
        
        /** current password and new password are the same */
        if (strcmp($request->input('current_password'), $request->input('password'))  == 0) {
            return redirect()->back()->withInput()->with("errorCurrentAndNewAreSame", "New Password cannot be same as your current password.");
        }

        $validatedData = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
                
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        try {
             # update user password
            User::findOrFail($auth->id)->update([
                'password' => Hash::make($request->password),
                'updated_at' => Carbon::now(),
            ]);
            Auth::logout();

            return redirect()->route('login')->with('success', 'Password updated successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

}
