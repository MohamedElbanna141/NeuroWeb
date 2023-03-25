<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
    
        // $request->authenticate();
        /* if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){
            Auth::user();
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
          return 'erooooooooor';
          return redirect()->intended(RouteServiceProvider::HOME);
        } */
        return redirect()->intended(RouteServiceProvider::HOME);

      
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
