<?php

namespace Database\Seeders;

use App\Modules\Customers\Models\Customer;
use App\Modules\Invoices\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::pluck('id')->toArray();

        foreach (range(1, 20) as $i) {
            Invoice::create([
                'customer_id' => $customers[array_rand($customers)],
                'amount' => rand(100, 1000),
                'date' => now()->addDays(rand(5, 30)),
                'status' => ['paid', 'unpaid', 'cancelled'][array_rand([0, 1, 2])]
            ]);
        }
    }

}
