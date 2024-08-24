<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'hotel_id' => 'required|exists:hotels,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_persons' => 'required|integer|min:1|max:5', // Based on the options provided
            'num_beds' => 'required|integer|min:1|max:5', // Based on the options provided
            'status' => 'required|boolean',
        ];
    }
}
