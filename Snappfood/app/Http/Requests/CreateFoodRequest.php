<?php

namespace App\Http\Requests;

use App\Rules\UniqueFood;
use Illuminate\Foundation\Http\FormRequest;

class CreateFoodRequest extends FormRequest
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
            'name' => ['required','string', new UniqueFood],
            'price' => 'required|integer',
            'raw_material' => '',
            'image' =>'',
            'type_of_food' => 'required'

        ];
    }
}
