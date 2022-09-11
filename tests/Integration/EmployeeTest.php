<?php

use App\Helpers\Helper;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class,RefreshDatabase::class);

it('should not add a employee without data', function () {
    //Act
    $response = $this->postJson('/api/v1/employee', []);
    
    //Assert
    $response->assertStatus(422);
});

it('should add a employee with data', function () {
    //Prepare
    $employee = Employee::factory()->raw();

    //Act
    $response = $this->postJson('/api/v1/employee', $employee);

    //Assert
    $response->assertStatus(201)->assertJson(['message' => 'Colaborador criado com sucesso!']);
    $this->assertDatabaseHas('employees', $employee);
});

it('should retrieve a Employee for ID with history salary', function () {
    //Prepare
    $employee = Employee::factory()->create();

    EmployeeSalary::factory()->count(1)->for($employee)->create();

    //Act
    $response = $this->getJson("/api/v1/employee/{$employee->id}");
    $data = [
        "status" => "Success",
        "statuscode" => 200,
        'message' => 'Colaborador recuperado com sucesso!',
        'data' => [
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
            'address_state' => $employee->address_state,
            'historySalary' => $employee->salary->toArray() ?? null
        ],
    ];
    
    //Assert
    $response->assertStatus(200)->assertJson($data);
});

it('should retrieve a Employee for CPF with history salary', function () {
    //Prepare
    $employee = Employee::factory()->create();

    EmployeeSalary::factory()->count(1)->for($employee)->create();

    //Act
    $response = $this->getJson("/api/v1/employee/{$employee->cpf}");
    $data = [
        "status" => "Success",
        "statuscode" => 200,
        'message' => 'Colaborador recuperado com sucesso!',
        'data' => [
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
            'address_state' => $employee->address_state,
            'historySalary' => $employee->salary->toArray() ?? null
        ],
    ];
    
    //Assert
    $response->assertStatus(200)->assertJson($data);
});

it('should update a employee', function () {
    //Prepare
    $employee = Employee::factory()->create();
    $employeeUpdated = [
        'id' => $employee->id,
        'fullname' => $employee->fullname,
        'cpf' => $employee->cpf,
        'rg' => '333333',
        'email' => $employee->email,
        'birthdata' => $employee->birthdata,
        'address' => $employee->address,
        'address_cep' => $employee->address_cep,
        'address_number' => $employee->address_number,
        'address_city' => $employee->address_city,
        'address_state' => $employee->address_state,
        "created_at" => $employee->created_at,
        "updated_at" => $employee->updated_at,
        "deleted_at" => $employee->deleted_at
    ];

    //Act
    $response = $this->putJson("/api/v1/employee/{$employee->id}", $employeeUpdated);

    //Assert
    $response->assertStatus(201)->assertJson(['message' => 'Colaborador Atualizado com sucesso!']);
    $this->assertDatabaseHas('employees', ['rg' => '333333']);
});

it('should erase a employee', function () {
    //Prepare
    $employee = Employee::factory()->create();

    //Act
    $response = $this->deleteJson("/api/v1/employee/{$employee->id}");
    
    //Assert
    $response->assertStatus(202);
    $this->assertCount(0, Employee::all());
});
