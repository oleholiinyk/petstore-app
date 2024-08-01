<?php

namespace App\Http\Requests;

use App\Enums\PetStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdatePetRequest extends FormRequest
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
            'name' => 'required|string',
            'status' => ['required', new Enum(PetStatus::class)],
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
