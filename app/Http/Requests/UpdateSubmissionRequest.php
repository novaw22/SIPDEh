<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\SubmissionStatuses;

class UpdateSubmissionRequest extends FormRequest
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
            "status" => [new Enum(SubmissionStatuses::class)],
            "pick_up_date" => "nullable|date",
            "admin_note" => "nullable|max:500",
            "soft_copy" => "nullable|file|mimes:pdf"
        ];
    }
}
