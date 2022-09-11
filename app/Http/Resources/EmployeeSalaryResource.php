<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSalaryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static function mapEmployeeSalaryResponse(object $employeeSalary)
    {
        return [
            'id' => $employeeSalary->id,
            'employee_id' => $employeeSalary->employee_id,
            'salary' => $employeeSalary->salary,
            'created_at'  => $employeeSalary->created_at
        ];
    }
}
