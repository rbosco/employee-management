<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 250);
            $table->string('cpf', 11)->unique();
            $table->string('rg', 100);
            $table->string('email', 150)->unique();
            $table->date('birthdata');
            $table->string('address', 250);
            $table->string('address_cep', 250);
            $table->string('address_number', 250);
            $table->string('address_city', 250);
            $table->string('address_state', 250);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
