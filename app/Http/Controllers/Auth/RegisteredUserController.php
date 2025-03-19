<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request->all());

        // Ambil role default 'user'
        $role = Role::where('name', 'user')->first(); 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role ? $role->id : 2, // Gunakan ID role 'user' jika ada, default ke 2
            'status' => 1,  // Aktif secara default
            'description' => $request->description,
        ]);

        event(new Registered($user));

        // Auth::login($user);
        Auth::logout();

        return redirect(route('login'))->with('success', 'Registration successful. Please log in.');
    
    } catch (\Exception $e) {
        // Log error untuk debugging
        \Log::error('Error during user registration: ' . $e->getMessage());

        // Redirect kembali dengan pesan error
        return redirect()->back()->withInput()->with('error', 'An error occurred during registration. Please try again.');
    }
}

}
