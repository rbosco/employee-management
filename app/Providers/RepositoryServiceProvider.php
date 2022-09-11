<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\EmployeeSalaryRepositoryInterface;
use App\Repository\EmployeeRepository;
use App\Repository\EmployeeSalaryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(EmployeeSalaryRepositoryInterface::class, EmployeeSalaryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
