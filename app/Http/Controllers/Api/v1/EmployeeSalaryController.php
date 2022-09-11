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
     *     @OA\Parameter(
     *         name="id_employee",
     *         in="query",
     *         description="Identificador do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="salary",
     *         in="query",
     *         description="Salário do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="float",
     *              format="flt",
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Salário do colaborador salvo com sucesso"),
     *     @OA\Response(response="422", description="Atributos não podem ser processados"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
    */
    public function store(Request $request): JsonResponse
    {
        return $this->employeeSalaryService->addEmployeeSalary($request);
    }
}
