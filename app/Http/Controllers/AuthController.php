<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $status = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($status) {
            return redirect()->to('dashboard');
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Either email or password did not match existing accounts.']);
        }
    }

    public function show()
    {
        return view('theme.login');
    }

    public function logout()
    {

    }
}
