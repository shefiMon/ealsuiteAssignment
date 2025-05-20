<?php

namespace App\Modules\Customers\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Services\CustomerService;
use Illuminate\Http\Request;



class CustomerController extends Controller
{

    public function index(){

        return view('customers.index');
    }

    /**
     * Show form for creating new customer
     */
    public function create()
    {
        return view('customers.create');
    }


    /**
     * Show form for editing customer
     */
    public function edit($customerId, CustomerService $service)
    {
        $customer = $service->getById($customerId);

        return view('customers.edit', compact('customer'));
    }

}
