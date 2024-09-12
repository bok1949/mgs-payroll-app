<?php

namespace App\Http\Controllers\Payroll;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


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
}
