<?php

use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class,RefreshDatabase::class);

it('should add salary for employee', function () {
    //Prepare
    $employee = Employee::factory()->create();
    $employeeSalary = [
        'employee_id' => $employee->id,
        'salary' => 9999.99
    ];

    //Act
    $response = $this->postJson('/api/v1/employeesalary', $employeeSalary);
    
    //Assert
    $response->assertStatus(201)->assertJson(['message' => 'Salário cadastrado com sucesso!']);
    $this->assertDatabaseHas('employee_salaries', $employeeSalary);
});