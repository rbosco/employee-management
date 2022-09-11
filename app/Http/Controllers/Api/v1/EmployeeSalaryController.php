<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Models\EmployeeSalary;
use App\Services\EmployeeSalaryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeeSalaryController extends ApiController
{
    public function __construct(
        private EmployeeSalary $employeeSalary, 
        private EmployeeSalaryRequest $employeeSalaryRequest,
        private EmployeeSalaryService $employeeSalaryService
    )
    {
        $this->employeeSalary = $employeeSalary;
        $this->employeeSalaryRequest = $employeeSalaryRequest;
        $this->employeeSalaryService = $employeeSalaryService;
    }

    /**
     * @OA\Post(
     *     tags={"Salary"},
     *     summary="Cadastra salário",
     *     description="Cadastra salário de um colaborador",
     *     path="/api/v1/employeesalary",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example={
     *                  "employee_id": "",
     *                  "salary": "",
     *              },
     *              @OA\Schema (
     *                  type="object",
     *                  @OA\Property(property="employee_id", required=true, description="ID do colaborador", type="integer"),
     *                  @OA\Property(property="salary", required=true, description="Salário", type="number")
     *             )
     *          )
     *     ),
     *     @OA\Response(response="200", description="Salário do colaborador salvo com sucesso"),
     *     @OA\Response(response="422", description="Atributos não podem ser processados"),
     *     @OA\Response(response="500", description="Erro interno do servidor"),
     * ),
     */
    public function store(Request $request): JsonResponse
    {
        return $this->employeeSalaryService->addEmployeeSalary($request);
    }
}
