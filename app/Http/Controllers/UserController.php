<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserInterface;
use App\Http\Requests\User\UserCreateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserCreateRequest $request)
    {   
        $user = $this->userRepository->createUserRepository($request);

        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $user,
        ]);
    }
}

