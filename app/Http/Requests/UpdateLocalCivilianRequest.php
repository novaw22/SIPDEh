<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocalCivilianRequest extends FormRequest
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
            "fullname" => "required|max:255",
            "nik" => "required|regex:/^[0-9]+$/|unique:profiles,nik",
            "date_of_birth" => "required|date",
            "place_of_birth" => "required|max:255",
            "address" => "required|max:255"
        ];
    }
}
