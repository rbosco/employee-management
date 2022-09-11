<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface 
{
    public function getAllEmployees();
    public function getEmployeeByIdOrCpf(int $filter);
    public function addEmployee(array $employeeData);
    public function updateEmployee($employeeId, array $employeeData);
    public function deleteEmployee($employeeId);
}