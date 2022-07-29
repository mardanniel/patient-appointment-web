<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Providers\RouteServiceProvider;
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
        return view('patient.auth.register');
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
        $request->validate([
            'fname' => ['required', 'string', 'max:50'],
            'mname' => ['required', 'string', 'max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'boolean'],
            'dob' => ['required', 'date'],
            'contact_num' => ['required', 'string', 'regex:/[0-9]{10}/'],
            'street' => ['required', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
            'barangay' => ['required', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
            'city' => ['required', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
        ]);

        $user = Patient::create([
            'fname' => strip_tags($request->fname),
            'mname' => strip_tags($request->mname),
            'lname' => strip_tags($request->lname),
            'email' => strip_tags($request->email),
            'password' => Hash::make($request->password),
            'gender'=> $request->gender,
            'dob' => $request->dob,
            'contact_num' => $request->contact_num,
            'street' => $request->street,
            'barangay' => $request->barangay,
            'city' => $request->city
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::PATIENT_HOME);
    }
}
