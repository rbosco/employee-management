<?php

namespace App\Http\Requests;

class EmployeeUpdateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'string',
            'rg' => 'string|numeric',
            'birthdata' => 'date',
            'address' => 'string',
            'address_cep' => 'string|numeric|digits_between:8,8',
            'address_city' => 'string',
            'address_number' => 'string|numeric',
            'address_state' => 'string|min:2|max:2|regex:/^[a-zA-Z ]+$/',
        ];
    }
}
