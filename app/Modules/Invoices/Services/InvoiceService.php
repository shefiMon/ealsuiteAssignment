<?php

namespace App\Modules\Invoices\Services;

use App\Modules\Invoices\Models\Invoice;

class InvoiceService implements \App\Interfaces\ModuleServiceInterface
{
    public function list($requst)
    {
        $query = Invoice::with('customer');
        if ($requst->has('status')) {
            $query->where('status', $requst->status);
        }
        if ($requst->has('customer_id')) {
            $query->where('customer_id', $requst->customer_id);
        }

        if ($requst->has('date')) {
            $query->whereDate('date', $requst->date);
        }



        return $query->orderBy('id',"desc")->paginate(10);
    }

    public function getById($id)
    {
        return Invoice::findOrfail($id);
    }

    public function create(array $data)
    {
        // Validate the data

        $validator = validator($data, [
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,cancelled'
        ]);

        if ($validator->fails()) {

            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'status' => false,
                    'errorMsg' => $validator->errors()->first()
                ], 422)
            );
        }

        return Invoice::create($data);
    }

    public function update($id, array $data)
    {

        $validator = validator($data, [
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,cancelled'
        ]);
        if ($validator->fails()) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'status' => false,
                    'errorMsg' => $validator->errors()->first()
                ], 422)
            );
        }
        $invoice = Invoice::findOrFail($id);
        $invoice->update($data);
        return $invoice;
    }

    public function delete($id)
    {
       return Invoice::destroy($id);
    }
}

