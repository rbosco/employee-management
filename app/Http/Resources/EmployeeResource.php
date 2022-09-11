<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static function mapEmployeeResponse(object $employee, $filter = null): array
    {
    
        $data = [
            'id' => $employee->id,
            'fullname' => $employee->fullname,
            'birthdata' => Helper::formataData($employee->birthdata),
            'cpf' => $employee->cpf,
            'rg' => $employee->rg,
            'email' => $employee->email,
            'address' => $employee->address,
            'address_cep' => $employee->address_cep,
            'address_number' => $employee->address_number,
            'address_city' => $employee->address_city,
            'address_state' => $employee->address_state
        ];

        if(!empty($filter)){
            $data['historySalary'] = $employee->salary->toArray();
        }
        
        return $data;
    }
}
