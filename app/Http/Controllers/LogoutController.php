<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function store()
    {
        // dd('cerrando sesión');
        auth()->logout();
        return redirect()->route('login');
    }
}
