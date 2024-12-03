<?php

namespace App\Http\Requests\Task;

use App\Enum\StatusTaskEnum;
use App\Traits\CustomFormRequestFailed;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title'       => 'required|string',
            'description' => 'required|string',
            //'user_id'     => 'required|integer|exists:users,id',
            'status'      => ['required', 'string', function ($attribute, $value, $fail) {
                if (!in_array($value, array_column(StatusTaskEnum::cases(), 'value'))) {
                    $fail("The $attribute must be one of: " . implode(', ', array_column(StatusTaskEnum::cases(), 'value')));
                }
            }],

        ];
    }
}
