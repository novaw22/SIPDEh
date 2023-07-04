<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminUserProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "password" => "nullable|min:6|max:32",
            "fullname" => "required|max:255",
            "phone" => "required|min:12|max:12|regex:/^[0-9]+$/",
            "address" => "required|max:500",
            "place_of_birth" => "max:100",
            "date_of_birth" => "date",
        ];
    }
}
