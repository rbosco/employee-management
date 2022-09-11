<?php

 namespace App\Repository;

use App\Interfaces\EmployeeSalaryRepositoryInterface;
use App\Models\EmployeeSalary;

 class EmployeeSalaryRepository extends AbstractRepository implements EmployeeSalaryRepositoryInterface
 {

    public function __construct(
        private EmployeeSalary $employeeSalary
    )
    {
        $this->employeeSalary = $employeeSalary;
    }

    public function addEmployeeSalary(array $employeeSalaryData)
    {
        return $this->employeeSalary->create($employeeSalaryData);
    }
 }
