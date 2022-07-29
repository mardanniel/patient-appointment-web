<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Profile extends Controller
{

    public function index()
    {
        return view('patient.profile.index');
    }

    public function edit()
    {
        return view('patient.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'alpha_dash', 'max:50'],
            'mname' => ['required', 'string', 'alpha_dash', 'max:50'],
            'lname' => ['required', 'string', 'alpha_dash', 'max:50'],
            'gender' => ['required', 'boolean'],
            'dob' => ['required', 'date'],
            'contact_num' => ['required', 'string', 'regex:/[0-9]{10}/'],
            'street' => ['required', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
            'barangay' => ['required', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
            'city' => ['required', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
        ]);

        $user = Auth::user();

        $user->update($request->all());

        return redirect()->route('patient.profile.index')
            ->with('success','Profile updated successfully! ✍(◔◡◔)');
    }
}
