<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $this->sanitizeInput($request);

        // Your authentication logic here
    }

    protected function credentials(Request $request)
    {
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $password = $request->password;

        return ['email' => $email, 'password' => $password];
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    }

    /**
     * Sanitize the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function sanitizeInput(Request $request)
    {
        $request->merge([
            'email' => filter_var($request->email, FILTER_SANITIZE_EMAIL),
        ]);
    }
}
