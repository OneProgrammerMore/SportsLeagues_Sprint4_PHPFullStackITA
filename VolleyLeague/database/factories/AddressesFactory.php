<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Addresses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class AddressesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Addresses::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->country(),
            'postalcode' => fake()->postcode(),
            'city' => fake()->city(),
            'street' => fake()->streetAddress(),
            'number' => fake()->buildingnumber(),
            'floor' => fake()->randomElement(['ground floor', '1st', '2nd', '3rd', '4th', '5th', '6th']),
            'door' => fake()->randomElement(['ground floor', '1st', '2nd', '3rd', '4th', '5th', '6th']),
        ];
        /*
        'country',
        'postalcode',
        'city',
        'street',
        'number',
        'floor',
        'door',
        */
    }
}