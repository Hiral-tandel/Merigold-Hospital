<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15|regex:/^[0-9+\-\s()]*$/',
            'specialization' => 'required|string|max:255',
            'education' => 'required|string|max:1000',
            'experience' => 'required|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=200,min_height=200',
            'about' => 'nullable|string|max:1000'
        ];

        // Add unique email rule except for current doctor when updating
        if ($this->isMethod('post')) {
            $rules['email'] .= '|unique:doctors';
        } else {
            $rules['email'] .= '|unique:doctors,email,' . $this->route('doctor');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the doctor\'s name.',
            'name.regex' => 'Name can only contain letters, spaces, and hyphens.',
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'phone.required' => 'Please enter a phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'specialization.required' => 'Please enter the doctor\'s specialization.',
            'education.required' => 'Please enter the doctor\'s education details.',
            'experience.required' => 'Please enter the doctor\'s experience.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'photo.max' => 'The image must not be larger than 2MB.',
            'photo.dimensions' => 'The image must be at least 200x200 pixels.',
            'about.max' => 'The about section cannot exceed 1000 characters.'
        ];
    }
} 