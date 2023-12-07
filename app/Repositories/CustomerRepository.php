<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;
use App\Http\Requests\Customer\CustomerInfoRequest;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Http\Requests\Customer\CustomerDeleteRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Repositories\Contracts\CustomerInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class CustomerRepository implements CustomerInterface
{
    public function customerInfoRepository(CustomerInfoRequest $request)
    {
        try {
            $customer = Customer::with('region', 'commune')
                ->where(function ($query) use ($request) {
                    $query->where('dni', $request->dni)
                        ->orWhere('email', $request->email);
                })
                ->where('status', Customer::CUSTOMER_ACTIVE)
                ->firstOrFail();

            return new CustomerResource($customer);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'No se encontraron clientes activos.'], 404);
        } catch (Throwable $exception) {
            return response()->json(['success' => false, 'message' => 'Error en la consulta.'], 500);
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
        return Customer::where('dni', $request->dni)
        ->update(['status' => Customer::CUSTOMER_TRASH_STATUS]);
    }
}
