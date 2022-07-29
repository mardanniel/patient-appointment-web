<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\Patient;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function loginForm()
    {
        return view('admin.auth.login');
    }


    public function authenticate(LoginRequest $request)
    {
        $request->authenticate('admin');

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    public function patientsList(){

        return view('admin.patient.list');

    }

    public function getPatientsList(Request $request){

        $q = strtolower(
            ctype_alpha($request->input('q')) 
            ? $request->input('q') 
            : ''
        );

        $patients = DB::table('patients as p')
                        ->select('id', 'fname', 'mname', 'lname', 'email', 'is_active')
                        ->when($q, function($query, $q){
                            return $query->where(DB::raw('CONCAT(p.fname, " ", p.mname, " ", p.lname)'), 'like', '%'.strip_tags($q).'%');
                        })
                        ->paginate(20)
                        ->appends('q', $q);
    
        return response()->json([
            'patients' => $patients,
            'links' => (string) $patients->links()
        ]);
    }

    public function viewPatient($id){

        $patient = Patient::where('id', strip_tags($id))->first();

        return view('admin.patient.show', compact('patient'));

    }

    public function togglePatientAccountStatus(Request $request){

        try {

            $patient_account_status = Patient::findOrFail(strip_tags($request->id));

            $patient_account_status->is_active = !boolval($patient_account_status->is_active);

            $patient_account_status->save();

            return redirect()->route('admin.patients-list');

        }catch(ModelNotFoundException $e){

            return redirect()->route('admin.patients-list');

        }

    }

    public function doctorsList(){

        return view('admin.doctor.list');

    }

    public function getDoctorsList(Request $request){

        $q = strtolower(
            ctype_alpha($request->input('q')) 
            ? $request->input('q') 
            : ''
        );

        $doctors = DB::table('doctors as d')
                        ->select('id', 'fname', 'mname', 'lname', 'email', 'degree', 'expertise', 'is_active')
                        ->when($q, function($query, $q){
                            return $query->where(DB::raw('CONCAT(d.fname, " ", d.mname, " ", d.lname)'), 'like', '%'.strip_tags($q).'%');
                        })
                        ->paginate(20)
                        ->appends('q', $q);;
    
        return response()->json([
            'doctors' => $doctors,
            'links' => (string) $doctors->links()
        ]);
    }

    public function doctorRegistrationForm(){

        return view('admin.doctor.register');

    }

    public function storeDoctorRegistration(DoctorRequest $request){
        
        Doctor::create(array_merge($request->validated(), [
            'password' => Hash::make($request->password)
        ]));

        return redirect()->route('admin.doctors-list')
                            ->with('success', 'Successfully registered a doctor! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧');

    }

    public function viewDoctor($id){

        $doctor = Doctor::where('id', $id)->first();

        return view('admin.doctor.show', compact('doctor'));

    }

    public function toggleDoctorAccountStatus(Request $request){

        try {

            $doctor_account_status = Doctor::findOrFail($request->id);

            $doctor_account_status->is_active = !boolval($doctor_account_status->is_active);

            $doctor_account_status->save();

            return redirect()->route('admin.doctors-list');

        }catch(ModelNotFoundException $e){

            return redirect()->route('admin.doctors-list');

        }

    }

    public function logout(Request $request){

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');

    }
}
