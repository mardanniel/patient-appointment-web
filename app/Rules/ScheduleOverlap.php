<?php

namespace App\Rules;

use App\Models\DoctorSchedule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ScheduleOverlap implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $sched_day;

    protected $sched_time_start;

    protected $sched_time_end = null;

    protected $sched_id;

    protected $doctor_id = null;


    // For doctors
    public static function schedule($sched_day, $sched_time_start, $sched_time_end, $sched_id = null)
    {
        $instance = new self();

        $instance->sched_day = $sched_day;

        $instance->sched_time_start = $sched_time_start;

        $instance->sched_time_end = $sched_time_end;

        $instance->sched_id = $sched_id;

        return $instance;
    }

    // For patients
    public static function appointment($appointment_datetime, $doctor_id)
    {
        $instance = new self();

        $instance->sched_day = intval(date('w', strtotime($appointment_datetime)));

        $instance->sched_time_start = date('H:i', strtotime($appointment_datetime));
    
        $instance->doctor_id = $doctor_id;

        return $instance;

    }

    public function passes($attribute, $value)
    {

        $daysOfTheWeek = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];

        $queryCount = DoctorSchedule::where('doctor_id', $this->doctor_id ?? Auth::id())
                            ->where('sched_day', $daysOfTheWeek[$this->sched_day])
                            ->when($this->sched_id != null, function($query){
                                return $query->where('id', '!=', $this->sched_id);
                            })
                            ->when($this->sched_time_end != null, function($query){
                                return $query->where('sched_time_start', '<=', $this->sched_time_end)
                                             ->where('sched_time_end', '>=', $this->sched_time_start);
                            })
                            ->when($this->sched_time_end == null, function($query){
                                return $query->whereRaw('time(?) BETWEEN time(`sched_time_start`) AND time(`sched_time_end`)', [$this->sched_time_start]);
                            })->count();
        
        return $this->sched_time_end ? $queryCount == 0 : $queryCount > 0;
            
    }

    public function message()
    {
        return $this->sched_time_end 
        ? 'Given schedule already overlaps from other schedules.'
        : 'Given appointment does not overlap within any of the doctor\'s schedule.';
    }
}
