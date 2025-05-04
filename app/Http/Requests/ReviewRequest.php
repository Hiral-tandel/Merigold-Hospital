<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Name can only contain letters, spaces, and hyphens.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'rating.required' => 'Please select a rating.',
            'rating.integer' => 'Rating must be a number.',
            'rating.min' => 'Rating must be at least 1.',
            'rating.max' => 'Rating cannot be more than 5.',
            'comment.required' => 'Please enter your review comment.',
            'comment.min' => 'Review comment must be at least 10 characters long.',
            'comment.max' => 'Review comment cannot exceed 1000 characters.'
        ];
    }
} 