<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'alpha_spaces|min:3',
            'last_name' => 'alpha_spaces|min:3',
            'password' => 'string|min:5',
            'position' => 'alpha_spaces|min:3',
            'active' => 'boolean',
            'status' => 'boolean',
        ];
        switch ($this->method()) {
            case 'POST': {
                $rules['username'] = 'alpha_num|min:3|unique:users,username';
                foreach (array_slice($rules, 0, 5) as $key => $rule) {
                    $rules[$key] = implode('|', ['required', $rule]);
                }
                return $rules;
            }
            case 'PUT':
            case 'PATCH': {
                return $rules;
            }
        }
    }
}