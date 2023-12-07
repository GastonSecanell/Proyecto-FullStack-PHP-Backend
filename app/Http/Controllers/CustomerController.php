<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerInfoRequest;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Http\Requests\Customer\CustomerDeleteRequest;
use App\Repositories\Contracts\CustomerInterface;

class CustomerController extends Controller
{
    protected CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function customerInfo(CustomerInfoRequest $request)
    {
        $customerInfo = $this->customerRepository->customerInfoRepository($request);

        return response()->json([
            'success' => true,
            'data' => $customerInfo,
        ]);
    }

    public function createCustomer(CustomerCreateRequest $request)
    {
        $customer = $this->customerRepository->createCustomerRepository($request);

        return response()->json([
            'success' => true,
            'message' => 'Cliente registrado correctamente',
            'data' => $customer,
        ]);
    }

    public function deleteCustomer(CustomerDeleteRequest $request)
    {   
        $result = $this->customerRepository->deleteCustomerRepository($request);

        return response()->json([
            'success' => true,
            'message' => $result,
        ]);
    }
}