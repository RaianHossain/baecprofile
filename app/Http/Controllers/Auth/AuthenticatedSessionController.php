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
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return redirect()->intended(RouteServiceProvider::HOME); // '/dashboard'
        }

        if ($user->hasRole('researcher')) {
            // $employee = $user->employee;

            // if ($employee && $employee->EmpID) {
            //     return redirect()->route('frontend.show', ['slug' => $employee->EmpID]);
            // }

            // // Optional fallback if EmpID is missing
            // abort(403, 'No employee profile associated with your account.');
            return redirect()->route('frontend.home');
        }

        // Optional fallback for other roles
        return redirect()->intended('/');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
