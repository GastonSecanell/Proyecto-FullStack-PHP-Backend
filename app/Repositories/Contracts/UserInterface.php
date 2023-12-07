<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;
use App\Http\Requests\User\UserCreateRequest;

interface UserInterface
{
    public function createUserRepository(UserCreateRequest $request);

}
