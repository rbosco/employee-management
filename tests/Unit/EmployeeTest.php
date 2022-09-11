<?php

use App\Helpers\Helper;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class,RefreshDatabase::class);

it('function should not add a employee without data', function () {
    //Prepare
    //Act
    $response = $this->postJson('/api/v1/employee', []);
    
    //Assert
    $response->assertStatus(422);
});