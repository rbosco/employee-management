<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeeController extends ApiController
{
    public function __construct(
        private Employee $employee,
        private EmployeeService $employeeService
    )
    {
        $this->employee = $employee;
        $this->employeeService = $employeeService;
    }

    /**
     * @OA\Get(
     *     tags={"Employee"},
     *     summary="Retorna lista de colaboradores",
     *     description="Retorna lista de colaboradores",
     *     path="/api/v1/employee",
     *     @OA\Response(response="200", description="Lista de colaboradores"),
     *     @OA\Response(response="404", description="Nenhuma lista de colaboradores encontrada"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
     */
    public function index()
    {
        return $this->employeeService->getAllEmployees();
    }

    /**
     * @OA\Get(
     *     tags={"Employee"},
     *     summary="Retorna um colaborador",
     *     description="Retorna um colaborador",
     *     path="/api/v1/employee/{employee}",
     *     @OA\Parameter(
     *         name="employee",
     *         in="path",
     *         description="ID Employee",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64",
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Lista colaborador"),
     *     @OA\Response(response="404", description="Nenhum colaborador encontrado"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
    */
    public function show(Request $request, $filter): JsonResponse
    {
        return $this->employeeService->getEmployee($filter);
    }

    /**
     * @OA\Post(
     *     tags={"Employee"},
     *     summary="Cadastra colaborador",
     *     description="Cadastra colaborador",
     *     path="/api/v1/employee",
     *     @OA\Parameter(
     *         name="fullname",
     *         in="query",
     *         description="Nome completo do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="birthdata",
     *         in="query",
     *         description="Data de nascimento do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="date",
     *              format="date",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="cpf",
     *         in="query",
     *         description="CPF do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="rg",
     *         in="query",
     *         description="RG do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Endereço do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_cep",
     *         in="query",
     *         description="CEP de endereço do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_number",
     *         in="query",
     *         description="Número de endereço do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_city",
     *         in="query",
     *         description="Cidade do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_state",
     *         in="query",
     *         description="Estado do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Colaborador Salvo com Sucesso"),
     *     @OA\Response(response="422", description="Atributos não podem ser processados"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
    */
    public function store(Request $request): JsonResponse
    {
        return $this->employeeService->addEmployee($request);
    }

   /**
     * @OA\Put(
     *     tags={"Employee"},
     *     summary="Edita um colaborador",
     *     description="Edita um colaborador",
     *     path="/api/v1/employee/{employee}",
     *     @OA\Parameter(
     *         name="employee",
     *         in="path",
     *         description="ID do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64",
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="fullname",
     *         in="query",
     *         description="Nome completo do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="birthdata",
     *         in="query",
     *         description="Data de nascimento do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="date",
     *              format="date",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="cpf",
     *         in="query",
     *         description="CPF do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="rg",
     *         in="query",
     *         description="RG do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Endereço do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_cep",
     *         in="query",
     *         description="CEP de endereço do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_number",
     *         in="query",
     *         description="Número de endereço do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_city",
     *         in="query",
     *         description="Cidade do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="address_state",
     *         in="query",
     *         description="Estado do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Colaborador Salvo com Sucesso"),
     *     @OA\Response(response="422", description="Atributos não podem ser processados"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
    */
    public function update(Request $request, Employee $employee): JsonResponse
    {
        return $this->employeeService->updateEmployee($request, $employee);
    }

    /**
     * @OA\Delete(
     *     tags={"Employee"},
     *     summary="Deleta um colaborador",
     *     description="Deleta um colaborador",
     *     path="/api/v1/employee/{employee}",
     *     @OA\Parameter(
     *         name="employee",
     *         in="path",
     *         description="ID do colaborador",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64",
     *         ),
     *     ),
     *     @OA\Response(response="202", description="Colaborador deletado com sucesso"),
     *     @OA\Response(response="404", description="Nenhum colaborador encontrado"),
     *     @OA\Response(response="405", description="O método especificado para a solicitação é inválido"),
     *     @OA\Response(response="500", description="Erro interno no servidor")
     * ),
     *
    */
    public function destroy(Employee $employee): JsonResponse
    {
        return $this->employeeService->deleteEmployee($employee->id);
    }
}
