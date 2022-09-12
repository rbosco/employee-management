<?php

namespace Tests;

use App\Interfaces\EmployeeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class EmployeeRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnAllEmployees()
    {
        $mockRepository = $this->createMock(EmployeeRepositoryInterface::class);

        $mockEmployeesArray = [
            [
                "id" => 1,
                "fullname" => "Dr. Cláudia Madeira Matias Filho",
                "cpf" => "77830627410",
                "rg" => "131760289",
                "email" => "fabio.davila@example.net",
                "birthdata" => "2016-06-22",
                "address" => "Av. Ferreira, 86",
                "address_cep" => "64329033",
                "address_number" => "84322",
                "address_city" => "Alessandro d'Oeste",
                "address_state" => "MS",
                "created_at" => "2022-09-11 07:09",
                "updated_at" => "2022-09-11 07:09",
                "deleted_at" => null
            ],
            [
                "id" => 6,
                "fullname" => "Fernanda Laura Priscila de Paula",
                "cpf" => "17633983400",
                "rg" => "372038475",
                "email" => "fernanda_laura_depaula@rjnet.com.br",
                "birthdata" => "1987-01-17",
                "address" => "Rua Tabajara",
                "address_cep" => "64032088",
                "address_number" => "320",
                "address_city" => "Teresina",
                "address_state" => "PI",
                "created_at" => "2022-09-11 07:09",
                "updated_at" => "2022-09-11 07:09",
                "deleted_at" => null
            ]
        ];

        $mockRepository->expects($this->exactly(1))->method('getAllEmployees')->willReturn($mockEmployeesArray);

        $employees = $mockRepository->getAllEmployees();
        
        $this->assertNotEmpty($employees);
    }
}