<?php

use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Repository\EmployeeRepository;
use App\Repository\EmployeeSalaryRepository;

uses(Tests\TestCase::class);

it('should to verify if exist table Employee', function () {
    //Prepare
    $employee = new Employee();

    //Act
    $verifyIfExistEmployeeTable = new EmployeeRepository($employee);

    //Assert
    expect($verifyIfExistEmployeeTable)->toBeObject();
});

it('should to verify if exist table EmployeeSalary', function () {
    //Prepare
    $employeeSalary = new EmployeeSalary();

    //Act
    $verifyIfExistEmployeeSalaryTable = new EmployeeSalaryRepository($employeeSalary);
    
    //Assert
    expect($verifyIfExistEmployeeSalaryTable)->toBeObject();
});
