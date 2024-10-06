<?php

namespace App\Http\Controllers\Web\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\Admin\LoginRequest;

class LoginController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('admins.auth.login');
    }

    public function store(LoginRequest $loginRequest): \Illuminate\Http\RedirectResponse
    {
        if (!auth()->guard('admin')->attempt($loginRequest->validated())) {
            return redirect(route('admins.login'))->withErrors('oops invalid credentials');
        }
        else {
            $admin  = auth()->guard('admin')->user() ;
            if (auth()->guard('admin')->user()->type == 1) {
                return redirect()->route('dashboard.mokasherat.show' , $admin->mayear_id);
            } else if (auth()->guard('admin')->user()->type == 2) {
                return redirect()->route('dashboard.mokasherat_mokassy.show' , $admin->mayear_id  );
            } else {
                return redirect()->route('dashboard.index');
            }
        }
    }


    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        auth()->guard('admin')->logout();
        return redirect(route('admins.login'));
    }
}
