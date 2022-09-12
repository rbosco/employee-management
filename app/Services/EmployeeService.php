<?php

namespace App\Services;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class EmployeeService {
    
    use ApiResponser;

    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private EmployeeRequest $employeeRequest,
        private EmployeeUpdateRequest $employeeUpdateRequest
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeRequest = $employeeRequest;
        $this->employeeUpdateRequest = $employeeUpdateRequest;
    }

    public function getAllEmployees()
    {
        $employee = $this->employeeRepository->getAllEmployees();
 
        return new EmployeeCollection($employee);
    }

    public function getEmployee($filter): JsonResponse
    {
        if (!is_numeric($filter)) {
            return $this->errorMessages();
        }

        $employee = $this->employeeRepository->getEmployeeByIdOrCpf($filter);
        if(empty($employee)){
            return $this->errorResponse([], 404, 'Colaborador não encontrado');
        }

        return $this->successResponse(EmployeeResource::mapEmployeeResponse($employee, $filter), 'Colaborador recuperado com sucesso!');
    }

    public function addEmployee($request): JsonResponse
    {   
        if ($this->validateForm($request->all(), $this->employeeRequest->rules()) == true) {

            $employee = $this->employeeRepository->addEmployee($request->all());
            
            return $this->successResponse(EmployeeResource::mapEmployeeResponse($employee), 'Colaborador criado com sucesso!', 201);
        }

        return $this->errorMessages();
    }

    public function updateEmployee($request, $employee): JsonResponse
    {
        if ($this->validateForm($request->all(), $this->employeeUpdateRequest->rules()) == true) {
            
            $this->employeeRepository->updateEmployee($employee->id, $request->all());
            $employee = $this->employeeRepository->getEmployeeByIdOrCpf($employee->id);

            return $this->successResponse(EmployeeResource::mapEmployeeResponse($employee), 'Colaborador Atualizado com sucesso!', 201);
        }

        return $this->errorMessages();
    }

    public function deleteEmployee($employeeId): JsonResponse
    {
        $this->employeeRepository->deleteEmployee($employeeId);
        return $this->successResponse([], 'Colaborador Removido com sucesso!', 202);

    }
}