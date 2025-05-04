<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'user_type' => 'required|in:user,admin,doctor'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 6 characters long.',
            'user_type.required' => 'Please select your user type.',
            'user_type.in' => 'Invalid user type selected.'
        ];
    }
} 