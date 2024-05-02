<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'avatar' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'gender' => 'required|in:male,female',
            'mobile' => 'required|string|max:255|unique:users,mobile',
            'birthdate' => 'required|date_format:Y-m-d',
            'role_id' => 'required|exists:roles,id',
            'type' => 'required|string',
            'identification_number' => 'required|string',
            'identification_issued_date' => 'required|string',
            'url_reference' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Role is required.',
            'email.required' => 'Email is required.',
            'name.required' => 'Name is required.',
            'avatar.required' => 'Avatar is required.',
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
            'gender.required' => 'Gender is required.',
            'type.required' => 'ID is required.',
            'identification_number.required' => 'ID Number is required.',
            'identification_issued_date.required' => 'ID issued date is required.',
            
            'birthdate.required' => 'Birthdate is Required.',
            'mobile.required' => 'Mobile number is Required.',

            'birthdate.date_format' => 'Date Format must be Y-M-D.',

            'gender.in' => 'Please choose either male or female only.',
            
            'email.string' => 'Email must be a string.',
            'avatar.string' => 'Avatar must be a string.',
            'name.string' => 'Name must be a string.',
            'username.string' => 'Username must be a string.',
            'password.string' => 'Password must be a string.',
            
            'mobile.string' => 'Mobile number must be a string.',
            'mobile.unique' => 'Mobile number is already taken.',
            'website.string' => 'Website must be a string.',
            'mobile.max' => 'Mobile number must not exceed to 255 characters.',
            'email.email' => 'Please provide a valid email.',
            'email.unique' => 'Email provided already exists.',
            'category_id.exists' => 'Category does not exists.'
        ];
    }
}
