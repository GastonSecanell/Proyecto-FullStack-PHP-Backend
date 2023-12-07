<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;
use App\Http\Requests\Customer\CustomerInfoRequest;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Http\Requests\Customer\CustomerDeleteRequest;

interface CustomerInterface
{   
    public function customerInfoRepository(CustomerInfoRequest $request);

    public function createCustomerRepository(CustomerCreateRequest $request);

    public function deleteCustomerRepository(CustomerDeleteRequest $request);
}
