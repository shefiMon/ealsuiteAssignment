<?php

namespace Database\Seeders;

use App\Modules\Customers\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (range(1, 10) as $index) {
            Customer::create([
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'email' => fake()->unique()->safeEmail(),
                'address' => fake()->streetAddress(),
                'address2' => fake()->secondaryAddress(),
                'city' => fake()->city(),
                'state' => fake()->state(),
                'country' => fake()->country(),
                'postal_code' => fake()->postcode()
            ]);
        }
        // Customer::factory()->count(10)->create();
    }
}
