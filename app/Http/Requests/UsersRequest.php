<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'roles_ids' => 'required|array',
            'roles_ids.*' => [
                'required',
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    if (
                        $value == 3 && (in_array(1, request('roles_ids')) ||
                            in_array(2, request('roles_ids')))
                    ) {
                        $fail('El usuario de tipo cliente, no puede tener roles adicionales.');
                    }
                }
            ],
        ];

        return $rules;
    }
}
