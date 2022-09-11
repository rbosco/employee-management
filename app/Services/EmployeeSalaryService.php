<?php

namespace App\Services;

use App\Http\Requests\EmployeeSalaryRequest;
use App\Http\Resources\EmployeeSalaryResource;
use App\Interfaces\EmployeeSalaryRepositoryInterface;
use App\Models\EmployeeSalary;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class EmployeeSalaryService {

    use ApiResponser;

    public function __construct(
        private EmployeeSalaryRepositoryInterface $employeeSalaryRepository,
        private EmployeeSalaryRequest $employeeSalaryRequest
    )
    {
        $this->employeeSalaryRepository = $employeeSalaryRepository;
        $this->employeeSalaryRequest = $employeeSalaryRequest;
    }

    public function addEmployeeSalary($request): JsonResponse
    {
        if ($this->validateForm($request->all(), $this->employeeSalaryRequest->rules()) == true) {

            $employeeSalary = $this->employeeSalaryRepository->addEmployeeSalary($request->all());

            return $this->successResponse(EmployeeSalaryResource::mapEmployeeSalaryResponse($employeeSalary), 'Salário cadastrado com sucesso!', 201);
        }

        return $this->errorMessages();
    }
}