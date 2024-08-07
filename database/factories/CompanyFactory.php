<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'cif' => $this->faker->unique()->regexify('[A-Z]{1}[0-9]{7}[A-Z0-9]{1}'), // Genera un CIF aleatorio
            'color' => $this->faker->hexColor,
            'address' => $this->faker->address,
            'population' => $this->faker->city,
            'cp' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            //'logo' => $this->faker->imageUrl(640, 480, 'business', true), // URL de una imagen de ejemplo
        ];
    }
}
