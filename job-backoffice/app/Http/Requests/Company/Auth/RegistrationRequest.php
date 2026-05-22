<?php

namespace App\Http\Requests\Company\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
      'password_confirmation' => 'required|string|min:8|confirmed',
    ];
  }

  public function messages()
  {
    return [
      'first_name.required' => 'First name is required',
      'last_name.required' => 'Last name is required',
      'email.required' => 'Email is required',
      'email.email' => 'Email is invalid',
      'email.unique' => 'Email is already taken',
      'password.required' => 'Password is required',
      'password.min' => 'Password must be at least 8 characters long',
      'password.confirmed' => 'Passwords do not match',
      'password_confirmation.required' => 'Password confirmation is required',
      'password_confirmation.min' => 'Password confirmation must be at least 8 characters long',
      'password_confirmation.confirmed' => 'Passwords do not match',
    ];
  }
}
