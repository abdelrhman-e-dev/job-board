<?php

namespace App\Http\Requests\Company\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
      'token' => ['required', 'string'],
      'email' => ['required', 'email', 'exists:users,email'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'password_confirmation' => ['required', 'string'],
    ];
  }

  public function messages(): array
  {
    return [
      'token.required' => 'Reset token is missing',
      'email.required' => 'Email is required',
      'email.email' => 'Email is invalid',
      'email.exists' => 'Email does not exist',
      'password.required' => 'Password is required',
      'password.min' => 'Password must be at least 8 characters',
      'password.confirmed' => 'Passwords do not match',
      'password_confirmation.required' => 'Please confirm your password',
    ];
  }
}
