<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Merchant;
use Illuminate\Support\Str;

class MerchantFactory extends Factory
{

    protected $model = Merchant::class;

    public function definition()
    {
      
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => random_int(0,1),
            'birthdate' => $this->faker->dateTimeThisMonth(),
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->email,
            'mobile' => $this->faker->phoneNumber,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'approval' => random_int(0,1),
            'status' => random_int(0,1),
            'tin' => random_int(0,999),

        ];
    }
}
