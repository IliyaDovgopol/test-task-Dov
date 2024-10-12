<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;


class AuthController extends Controller
{
    // Shows the registration form
    public function register()
    {
        return view('auth.register');
    }

    // Handles the registration request
    // app/Http/Controllers/AuthController.php

	public function registerSubmit(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8|confirmed',
			// If there is a role selection in the form, add validation for role
			// 'role' => 'required|string|in:user,admin', // Example, if roles are predefined
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			// Assign a role. You can use selection from the form or a default value.
			'role' => $request->role ?? 'user', // For example, default role 'user'
		]);

		Auth::login($user);

		// Log the "registration" action
		ActivityLog::create([
			'user_id' => $user->id,
			'action' => 'registration',
			'description' => 'User registered',
		]);

		return redirect()->route('home');
	}



	// Shows the login form
	public function login()
	{
		return view('auth.login');
	}

	// Handles the login request
	public function loginSubmit(Request $request)
	{
		// Validate form data
		$request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string',
		]);

		// Attempt to authenticate the user
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

			// Log the "login" action
			ActivityLog::create([
				'user_id' => auth()->id(),
				'action' => 'login',
				'description' => 'User logged in',
			]);
	
			// If successful, redirect to the home page
			return redirect()->route('home');
		}

		// If unsuccessful, redirect back with an error
		return back()->withErrors([
			'email' => 'Invalid email or password.',
		]);
	}

	public function logout()
    {

		// Log the "logout" action
		ActivityLog::create([
			'user_id' => auth()->id(),
			'action' => 'logout',
			'description' => 'User logged out',
		]);

        // End the user session
        Auth::logout();

        // Redirect to the login or home page
        return redirect('/login');
    }

}
