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
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle post-authentication redirect.
     */
protected function authenticated(Request $request, $user)
{
    if ($user->is_admin) {
        return redirect()->route('admin.users.index');
    }

    return redirect()->route('user.property.index'); // أو أي مسار للمستخدم العادي
}
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
