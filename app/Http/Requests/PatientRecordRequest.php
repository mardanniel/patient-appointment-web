<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $redirectRoute = 'doctor.patient-record.create';

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'appointment_id' => 'required|exists:patient_appointments,id|integer',
            'patient_id' => 'required|exists:patient_appointments,patient_id|integer',
            'diagnosis' => 'required|max:255|string|regex:/^[a-zA-Z\s]*$/',
            'temp' => 'required|integer',
            'bp' => 'required|integer',
            'weight' => 'required|integer',
            'height' => 'required|integer',
            'pulse_rate' => 'required|integer'
        ];
    }

    protected function getRedirectUrl()
    {

        $url = $this->redirector->getUrlGenerator();

        return $url->route($this->redirectRoute, [$this->appointment_id]);

    }

    public function attributes()
    {
        return [
            'appointment_id' => 'Appointment ID',
            'patient_id' => 'Patient ID',
            'temp' => 'Temperature',
            'bp' => 'Blood Pressure',
            'pulse_rate' => 'Pulse Rate'
        ];
    }
}
