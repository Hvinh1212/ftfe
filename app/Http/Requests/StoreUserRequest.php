<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'date_of_birth' => $this->filled('date_of_birth') ? trim((string) $this->date_of_birth) : null,
            'phone' => $this->filled('phone') ? trim((string) $this->phone) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'user_flg' => 'required|integer',
            'date_of_birth' => 'nullable|date_format:Y/m/d',
            'phone' => 'nullable|string|max:32',
        ];
    }

    protected function passedValidation(): void
    {
        if ($this->filled('date_of_birth')) {
            $this->merge([
                'date_of_birth' => Carbon::createFromFormat('Y/m/d', $this->string('date_of_birth'))->format('Y-m-d'),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email must be less than 100 characters.',
            'email.unique' => 'The email address has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'user_flg.required' => 'The user flag field is required.',
            'user_flg.integer' => 'The user flag must be an integer.',
            'date_of_birth.date_format' => 'The date of birth must be in YYYY/MM/DD format.',
            'phone.max' => 'The phone must be less than 32 characters.',
        ];
    }
}
