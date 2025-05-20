<?php

namespace App\Modules\Invoices\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Invoices\Models\Invoice;
use App\Modules\Invoices\Services\InvoiceService;

class InvoiceController extends Controller
{

    public function index(){

        return view('invoices.index');
    }

    /**
     * Show form for creating new customer
     */
    public function create()
    {
        return view('invoices.create');
    }


    /**
     * Show form for editing customer
     */
    public function edit($invoiceId, InvoiceService $service)
    {
        $invoice = $service->getById($invoiceId);

        return view('invoices.edit', compact('invoice'));
    }

}
