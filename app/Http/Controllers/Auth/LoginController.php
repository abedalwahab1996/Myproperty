<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login by default.
     * @var string
     */
    protected $redirectTo = '/'; // Default path for regular users

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle post-authentication redirect.
     */
   protected function authenticated(Request $request, $user)
        {
            // Add logging to debug the issue
            \Log::info('Login redirect', [
                'user_id' => $user->id,
                'role' => $user->role,
                'isAdmin' => $user->isAdmin(),
                'route' => $user->role === 'admin' ? 'admin.users.index' : 'user.Property.index'
            ]);

            if ($user->role === 'admin') {
                return redirect()->route('admin.users.index');
            }

            return redirect()->route('user.Property.index');
        }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}