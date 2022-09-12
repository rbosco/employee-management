<?php

namespace Tests;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeSalaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidationRequestTest extends TestCase
{
    /**
     * @test
     */
     public function shouldValidateRequestAddEmployee()
     {
        //Prepare
        $request = new Request;
        $postRequest = new EmployeeRequest;
        $request->merge([]);

        //Act
        $validation = Validator::make($request->all(), $postRequest->rules());
        
        //Assert
        $this->assertNotNull($validation->getMessageBag()->getMessages());
     }
     
    /**
     * @test
     */
     public function shouldValidateRequestAddSalary()
     {
        //Prepare
        $request = new Request;
        $postRequest = new EmployeeSalaryRequest;
        $request->merge([]);

        //Act
        $validation = Validator::make($request->all(), $postRequest->rules());
        
        //Assert
        $this->assertNotNull($validation->getMessageBag()->getMessages());
     }
}