<?php

namespace App\Http\Requests;

use App\Enums\JobEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:applications'],
            'phone' => ['nullable', 'min:10'],
            'date_of_birth' => ['required', 'date', 'max:255'],
            'job' => ['required', new Enum(JobEnum::class)],
            'previous_experience' => ['nullable', 'in:1'],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email has already applied for this job.',
        ];
    }
}
