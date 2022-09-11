<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'cpf' => $this->faker->cpf(false),
            'rg' => $this->faker->rg(false),
            'email' => $this->faker->unique()->safeEmail,
            'birthdata' => $this->faker->date(),
            'address' => $this->faker->streetAddress(),
            'address_cep' => $this->faker->numerify('########'),
            'address_number' => $this->faker->buildingNumber(),
            'address_city' => $this->faker->city(),
            'address_state' => $this->faker->stateAbbr(),
        ];
    }
}
