<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $attempt = Auth::attempt($credentials);

        if(!$attempt) {
            return redirect('/')->with('failed', 'Failed to log in');
        }

        $user = Auth::user();

        if ( $user->role === Employee::ADMIN) {
            return redirect('/admin-dashboard')->with('success', 'Successfully logged in');
        } else if ($user->role === Employee::EMPLOYEE) {
            return redirect('/employee-dashboard')->with('success', 'Successfully logged in');
        }
    }

    public function logout(){

        Auth::logout();

        return redirect('/');
    }
}
