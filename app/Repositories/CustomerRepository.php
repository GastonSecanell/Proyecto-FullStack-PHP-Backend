<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;

use App\Http\Requests\Customer\CustomerInfoRequest;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Http\Requests\Customer\CustomerDeleteRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Repositories\Contracts\CustomerInterface;


class CustomerRepository implements CustomerInterface
{
    public function customerInfoRepository(CustomerInfoRequest $request)
    {
        $customer = Customer::with('region', 'commune')
            ->where(function ($query) use ($request) {
                $query->where('dni', $request->dni)
                      ->orWhere('email', $request->email);
            })
            ->where('status', Customer::CUSTOMER_ACTIVE)
            ->first();

        if ($customer) {
            return new CustomerResource($customer);
        } else {
            return response()->json(['success' => true, 'message' => 'No se encontraron clientes activos.'], 404);
        }
    }

    public function createCustomerRepository(CustomerCreateRequest $request)
    {   
        return Customer::create([
            'dni' => $request->dni,
            'id_reg' => $request->id_reg,
            'id_com' => $request->id_com,
            'email' => $request->email,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'date_reg' => now(),
            'status' => $request->status
        ]);
    }

    public function deleteCustomerRepository(CustomerDeleteRequest $request)
    {
        $customer = Customer::find($request->dni);

        if ($customer) {
            $customer->status = 'trash';
            $customer->save();
        }
        return $customer;
    }
}