<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addMonths(3)->format('Y-m-d')
            ],
            'appointment_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = strtotime($value);
                    $hour = date('H', $time);
                    if ($hour < 9 || $hour > 17) {
                        $fail('Appointments must be between 9:00 AM and 5:00 PM.');
                    }
                }
            ],
            'reason' => 'required|string|min:10|max:500'
        ];
    }

    public function messages()
    {
        return [
            'doctor_id.required' => 'Please select a doctor.',
            'doctor_id.exists' => 'The selected doctor is invalid.',
            'patient_name.required' => 'Please enter your name.',
            'patient_name.regex' => 'Name can only contain letters, spaces, and hyphens.',
            'appointment_date.required' => 'Please select an appointment date.',
            'appointment_date.after_or_equal' => 'Appointment date must be today or a future date.',
            'appointment_date.before_or_equal' => 'Appointments can only be booked up to 3 months in advance.',
            'appointment_time.required' => 'Please select an appointment time.',
            'appointment_time.date_format' => 'Please enter a valid time.',
            'reason.required' => 'Please provide a reason for your visit.',
            'reason.min' => 'Reason must be at least 10 characters long.',
            'reason.max' => 'Reason cannot exceed 500 characters.'
        ];
    }
} 