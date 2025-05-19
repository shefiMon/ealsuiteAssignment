<?php

namespace App\Modules\Customers\Services;

use App\Modules\Customers\Models\Customer;
use Illuminate\Http\Request;

class CustomerService implements \App\Interfaces\ModuleServiceInterface
{
    public function list($request)
    {
        try {
            $query = Customer::query();

            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
            }

            $perPage = $request->get('per_page', 10);
            return $query->paginate($perPage);
        } catch (\Exception $e) {
            throw new \Exception('Error listing customers: ' . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer;
        } catch (\Exception $e) {
            throw new \Exception('Customer not found');
        }
    }

    public function create(array $data)
    {
        try {
            $validator = validator($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255'
            ]);

            if ($validator->fails()) {

                throw new \Illuminate\Http\Exceptions\HttpResponseException(
                    response()->json([
                        'status' => false,
                        'errorMsg' => $validator->errors()->first()
                    ], 422)
                );
            }

            return Customer::create($data);
        } catch (\Exception $e) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'status' => false,
                    'errorMsg' => $validator->errors()->first()
                ], 422)
            );
        }
    }

    public function update($id, array $data)
    {
        try {
            $validator = validator($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255'
            ]);

            if ($validator->fails()) {

                throw new \Illuminate\Http\Exceptions\HttpResponseException(
                    response()->json([
                        'status' => false,
                        'errorMsg' => $validator->errors()->first()
                    ], 422)
                );
            }
            $customer = Customer::findOrFail($id);
            $customer->update($data);
            return $customer;
        } catch (\Exception $e) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'status' => false,
                    'errorMsg' => $e->getMessage()
                ], 422)
            );
        }
    }

    public function delete($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer->delete();
        } catch (\Exception $e) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'status' => false,
                    'errorMsg' => $e->getMessage()
                ], 422)
            );
        }
    }
}



