<?php

namespace App\Http\Requests\DoctorSchedule;

use App\Rules\ScheduleOverlap;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateScheduleRequest extends FormRequest
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
            'id' => [
                Rule::requiredIf($this->input('_method') == "PATCH"),
                'sometimes',
                'integer',
                'exists:doctor_schedules,id'
            ],
            'sched_time_start' => [
                'required', 
                'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/',
            ],
            'sched_time_end' => [
                'required', 
                'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/',
            ],
            'sched_day' => [
                'required',
                'integer',
                'between:0,6',
                ScheduleOverlap::schedule(
                    $this->input('sched_day'),
                    $this->input('sched_time_start'),
                    $this->input('sched_time_end'),
                    $this->input('id') ?? null,
                )
            ],
        ];
    }
}
