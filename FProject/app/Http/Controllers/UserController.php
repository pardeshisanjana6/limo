<?php

namespace App\Http\Controllers;
use Cashfree\PG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Booking;


class UserController extends Controller
{
    public function userlayout(){
        return view('users.userlayout');
    }

    public function showLoginForm(){
        return view('users.userlogin');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            
            $request->session()->regenerate();
            return redirect()->intended(route('home2')); 
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); 
    }

    public function showRegistrationForm(){
        return view('users.userregistration');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8|confirmed', 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended(route('login')); 
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home2'));
    }

    public function index()
    {
        $users = User::where('role', 'user')->oldest()->paginate(10);
        return view('admin.displayusers', compact('users'));
    }

    public function show(User $user) 
    {
        $user->load('bookings.vehicle');
        return view('users.userdetails', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
        
        ]);

        $user->update($validatedData);

        return response()->json(['success' => true, 'message' => 'User updated successfully.']);
    }

}
