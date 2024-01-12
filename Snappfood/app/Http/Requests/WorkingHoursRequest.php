<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkingHoursRequest extends FormRequest
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
            'sat-open' => 'required',
            'sat_start' => '',
            'sat_end' => '',
            'sun-open' => 'required',
            'sun_start' => '',
            'sun_end' => '',
            'mon-open' => 'required',
            'mon_start' => '',
            'mon_end' => '',
            'tue-open' => 'required',
            'tue_start' => '',
            'tue_end' => '',
            'wed-open' => 'required',
            'wed_start' => '',
            'wed_end' => '',
            'thu-open' => 'required',
            'thu_start' => '',
            'thu_end' => '',
            'fri-open' => 'required',
            'fri_start' => '',
            'fri_end' => '',
        ];
    }
}
