<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    
      //Display the login Page
     
 public function create(): View|RedirectResponse
{
   
    return view('auth.login');
} 

    

     //Logging into dashboard
     
    public function check(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user =Auth::user();//object contain login credentials

        
        //redirect based on role
        if($user->role === 'Admin')
        {
            return redirect()->route('admin.dashboard');
        }
        elseif($user->role === 'Employee')
        {
              return redirect()->route('employee.dashboard');
        }
        else{
        return redirect('/');
    }


$credentials = $request->only('email', 'password');

    $remember = $request->has('remember');  // check the box

    if (Auth::attempt($credentials, $remember)) {
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);

  }



  
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();//removes authentication details from session

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
