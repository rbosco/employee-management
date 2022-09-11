<?php

 namespace App\Repository;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

 class EmployeeRepository extends AbstractRepository implements EmployeeRepositoryInterface
 {

    public function __construct(
        private Employee $employee
    )
    {   
        $this->employee = $employee;
    }

    public function getAllEmployees()
    {
        return $this->employee->orderBy('created_at','DESC')->paginate(10);
    }

    public function getEmployeeByIdOrCpf($filter)
    {
        return $this->employee->where(['id' => $filter])->orWhere(['cpf' => $filter])->first();
    }

    public function addEmployee(array $employeeData)
    {
        return $this->employee->create($employeeData);
    }

    public function updateEmployee($employeeId, array $employeeData)
    {
        return $this->employee->whereId($employeeId)->update($employeeData);
    }

    public function deleteEmployee($employeeId)
    {
        return $this->employee->whereId($employeeId)->delete();
    }
 }
