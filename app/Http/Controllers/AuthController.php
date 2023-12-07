<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\DataErrorResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\TokenGenerator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{   
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $token = TokenGenerator::generateSHA1Token($user);
        $this->saveCustomToken($user, $token);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    private function saveCustomToken(User $user, $token)
    {
        DB::table('custom_tokens')->updateOrInsert(
            [
                'user_id' => $user->id,
            ],
            [
                'token' => $token,
                'login_time' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function logout(Request $request)
    {
        try {
            $authorizationHeader = $request->header('Authorization');

            if (!$authorizationHeader || !preg_match('/Bearer\s+(.+)/', $authorizationHeader, $matches)) {
                return response()->json(['message' => 'Unauthorized. Invalid authorization header.'], 401);
            }
    
            $token = $matches[1];

            DB::table('custom_tokens')->where('token', $token)->delete();
    
            return response()->json(['message' => 'Sesión cerrada correctamente']);
        } catch (\Throwable $th) {
            $dataError = new DataErrorResponse($th, static::class);
            $response = [
                'estado' => 'error',
                'message' => 'Ocurrió un error',
            ];
    
            return response()->json($response);
        }
    }

}
