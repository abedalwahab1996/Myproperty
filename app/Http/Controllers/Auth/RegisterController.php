<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirect to login page after registration
    protected $redirectTo = '/login ';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user', // Explicitly set user role
        ]);

        // If you're using Laratrust
        $user->addRole('user');

        return $user;
    }

    /**
     * The user has been registered.
     * (Optional: Add this if you need custom post-registration logic)
     */
    protected function registered(Request $request, $user)
    {
        // Optional: Send email verification notification
        $user->sendEmailVerificationNotification();
        
        // Flash message
        return redirect($this->redirectPath())
            ->with('success', 'Registration successful! Please log in.');
    }
}