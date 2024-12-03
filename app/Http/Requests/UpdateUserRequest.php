<?php

namespace App\Http\Requests;

use App\Traits\CustomFormRequestFailed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    use CustomFormRequestFailed;

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
    public function rules()
    {
        return [
            'first_name' => 'required|min:3',
            'last_name'  => 'required|min:2',
            'email'      => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user')), 
            ],
            'phone'      => [
                'required',
                Rule::unique('users')->ignore($this->route('user')), 
            ],
            'role'       => 'required',
        ];
    }
}
