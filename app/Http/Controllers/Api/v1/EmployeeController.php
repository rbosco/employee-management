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
     *         description="Identificador ou CPF do Colaborador",
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
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example={
     *                  "fullname": "",
     *                  "birthdata": "YYYY-MM-DD",
     *                  "cpf": "",
     *                  "rg": "",
     *                  "email": "",
     *                  "address": "",
     *                  "address_cep": "",
     *                  "address_number": "",
     *                  "address_city": "",
     *                  "address_state": "",
     *              },
     *              @OA\Schema (
     *                  type="object",
     *                  @OA\Property(property="fullname", required=true, description="Nome completo", type="string"),
     *                  @OA\Property(property="birthdata", required=true, description="Data de nascimento", type="string"),
     *                  @OA\Property(property="cpf", required=true, description="RG do colaborador", type="string"),
     *                  @OA\Property(property="rg", required=true, description="RG do colaborador", type="string"),
     *                  @OA\Property(property="email", required=true, description="E-mail do colaborador", type="string"),
     *                  @OA\Property(property="address", required=true, description="Endereço do colaborador", type="string"),
     *                  @OA\Property(property="address_cep", required=true, description="CEP do colaborador", type="string"),
     *                  @OA\Property(property="address_number", required=true, description="Número da residência do colaborador", type="string"),
     *                  @OA\Property(property="address_city", required=true, description="Cidade do colaborador", type="string"),
     *                  @OA\Property(property="address_state", required=true, description="Estado do colaborador", type="string"),
     *             )
     *          )
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
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example={
     *                  "fullname": "",
     *                  "birthdata": "YYYY-MM-DD",
     *                  "cpf": "",
     *                  "rg": "",
     *                  "email": "",
     *                  "address": "",
     *                  "address_cep": "",
     *                  "address_number": "",
     *                  "address_city": "",
     *                  "address_state": "",
     *              },
     *              @OA\Schema (
     *                  type="object",
     *                  @OA\Property(property="fullname", required=true, description="Nome completo", type="string"),
     *                  @OA\Property(property="birthdata", required=true, description="Data de nascimento", type="string"),
     *                  @OA\Property(property="cpf", required=true, description="RG do colaborador", type="string"),
     *                  @OA\Property(property="rg", required=true, description="RG do colaborador", type="string"),
     *                  @OA\Property(property="email", required=true, description="E-mail do colaborador", type="string"),
     *                  @OA\Property(property="address", required=true, description="Endereço do colaborador", type="string"),
     *                  @OA\Property(property="address_cep", required=true, description="CEP do colaborador", type="string"),
     *                  @OA\Property(property="address_number", required=true, description="Número da residência do colaborador", type="string"),
     *                  @OA\Property(property="address_city", required=true, description="Cidade do colaborador", type="string"),
     *                  @OA\Property(property="address_state", required=true, description="Estado do colaborador", type="string"),
     *             )
     *          )
     *     ),
     *     @OA\Response(response="200", description="Colaborador atualizado com Sucesso"),
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
