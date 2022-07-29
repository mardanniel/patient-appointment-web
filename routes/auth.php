<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Patient\Appointment;
use App\Http\Controllers\Patient\Profile;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:web', 'prefix' => 'patient', 'as' => 'patient.'],function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

});

Route::group(['middleware' => 'guest:doctor', 'prefix' => 'doctor', 'as' => 'doctor.'], function (){

    Route::get('login', [DoctorController::class, 'loginForm'])->name('login');

    Route::post('login', [DoctorController::class, 'authenticate'])->name('authenticate');


});

Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'as' => 'admin.'], function (){

    Route::get('login', [AdminController::class, 'loginForm'])->name('login');

    Route::post('login', [AdminController::class, 'authenticate'])->name('authenticate');

});


Route::middleware('auth:web')->group(function () {

    Route::name('verification.')->group(function () {

        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->name('notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware('throttle:6,1')
                    ->name('send');

    });

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::group(['middleware' => ['verified', 'auth:web'], 'prefix' => 'patient', 'as' => 'patient.'], function () {

        Route::get('dashboard', [DashboardController::class, 'patientDashboard'])->name('dashboard');

        Route::get('randomDoctor', [DashboardController::class, 'randomDoctor'])->name('randomDoctor');

        Route::resource('profile', Profile::class);

        Route::get('appointment/create/{doctor_id}', [Appointment::class, 'create'])->name('appointment.create');

        Route::get('appointment/list', [Appointment::class, 'list'])->name('appointment.list');

        Route::delete('appointment/delete', [Appointment::class, 'destroy'])->name('appointment.destroy');

        Route::resource('appointment', Appointment::class)->except(['create', 'edit', 'update', 'destroy']);

    });

});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    Route::get('patients-list', [AdminController::class, 'patientsList'])->name('patients-list');

    Route::get('patients', [AdminController::class, 'getPatientsList'])->name('getPatients');

    Route::get('patient/{id}', [AdminController::class, 'viewPatient'])->name('patient.view');

    Route::post('patient/acc-status-toggle', [AdminController::class, 'togglePatientAccountStatus'])->name('patient.acc-status.toggle');

    Route::get('doctors-list', [AdminController::class, 'doctorsList'])->name('doctors-list');

    Route::get('doctors', [AdminController::class, 'getDoctorsList'])->name('getDoctors');

    Route::get('doctor/create', [AdminController::class, 'doctorRegistrationForm'])->name('doctor.create');

    Route::post('doctor/store', [AdminController::class, 'storeDoctorRegistration'])->name('doctor.store');

    Route::get('doctor/{id}', [AdminController::class, 'viewDoctor'])->name('doctor.view');

    Route::post('doctor/acc-status-toggle', [AdminController::class, 'toggleDoctorAccountStatus'])->name('doctor.acc-status.toggle');

    Route::post('logout', [AdminController::class, 'logout'])->name('logout');

});

Route::group(['middleware' => 'auth:doctor', 'prefix' => 'doctor', 'as' => 'doctor.'], function () {

    Route::get('appointments', [DoctorController::class, 'viewAppointments'])->name('appointments');

    Route::get('appointment/{appointment_id}', [DoctorController::class, 'viewAppointment'])->name('appointment.view');

    Route::get('schedules', [DoctorController::class, 'viewSchedules'])->name('schedules');
    
    Route::get('schedule/edit/{sched_id}', [DoctorController::class, 'editSchedule'])->name('schedule.edit');

    Route::delete('schedule/remove', [DoctorController::class, 'removeSchedule'])->name('schedule.remove');

    Route::patch('schedule/update', [DoctorController::class, 'updateSchedule'])->name('schedule.update');

    Route::get('schedule/create', [DoctorController::class, 'createSchedule'])->name('schedule.create');

    Route::post('schedule/store', [DoctorController::class, 'storeSchedule'])->name('schedule.store');

    Route::get('patient-records', [DoctorController::class, 'viewPatientRecords'])->name('patient-records');

    Route::get('patient-records/list', [DoctorController::class, 'getPatientRecords'])->name('patient-records.list');

    Route::get('patient-record/{patient_id}', [DoctorController::class, 'viewPatientRecord'])->name('patient-record.view');

    Route::get('patient-record/create/{appointment_id}', [DoctorController::class, 'createPatientRecord'])->name('patient-record.create');

    Route::post('patient-record/store', [DoctorController::class, 'storePatientRecord'])->name('patient-record.store');

    Route::post('logout', [DoctorController::class, 'logout'])->name('logout');

});
