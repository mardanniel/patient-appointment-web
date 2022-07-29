<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

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
            'fname' => [
                'required', 
                'string',
                'max:50', 
                'regex:/^[a-zA-Z\s]*$/'
            ],
            'mname' => [
                'required', 
                'string', 
                'max:50', 
                'regex:/^[a-zA-Z\s]*$/'
            ],
            'lname' => [
                'required', 
                'string', 
                'max:50', 
                'regex:/^[a-zA-Z\s]*$/'
            ],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:patients'
            ],
            'password' => [
                'required', 
                'confirmed', 
                Rules\Password::defaults()
            ],
            'gender' => [
                'required', 
                'boolean'
            ],
            'dob' => [
                'required', 
                'date'
            ],
            'contact_num' => [
                'required', 
                'string', 
                'regex:/[0-9]{10}/'
            ],
            'street' => [
                'required', 
                'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'
            ],
            'barangay' => [
                'required', 
                'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'
            ],
            'city' => [
                'required', 
                'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'
            ],
            'degree' => [
                'required', 
                'string', 
                'max:50', 
                'regex:/^[a-zA-Z\s]*$/'
            ],
            'expertise' => [
                'required',
                'string', 
                'max:50', 
                'regex:/^[a-zA-Z\s]*$/'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'contact_num' => 'Contact Number'
        ];
    }

}
