<?php

namespace App\Http\Requests;

class EmployeeRequest
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
            'fullname' => 'required|string',
            'cpf' => 'sometimes|required|string|numeric|digits_between:11,11',
            'rg' => 'required|string|numeric',
            'birthdata' => 'required|date',
            'email' => 'sometimes|required|string',
            'address' => 'required|string',
            'address_cep' => 'required|string|numeric|digits_between:8,8',
            'address_city' => 'required|string',
            'address_number' => 'required|string|numeric',
            'address_state' => 'required|string|min:2|max:2|regex:/^[a-zA-Z ]+$/',
        ];
    }
}
