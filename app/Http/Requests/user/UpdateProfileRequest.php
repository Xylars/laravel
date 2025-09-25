<?php

namespace App\Http\Requests\user;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $user = auth()->user();
        return [
            "name"=> "required|string|max:30",
            "email" => ["required", "email", "max:255", Rule::unique('users', 'email')->ignore($user->id)],
            "phone" => "required|string",
            "bio" => "string",
            "avatar" => "file|mimes:jpg,jpeg,png|max:2048"
        ];
    }
}
