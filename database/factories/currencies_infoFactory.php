<?php

namespace Database\Factories;

use App\Models\currencies_info;
use Illuminate\Database\Eloquent\Factories\Factory;

class currencies_infoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = currencies_info::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_id' => $this->faker->randomDigitNotNull,
        'value' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
