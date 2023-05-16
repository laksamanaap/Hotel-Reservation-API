<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
 /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/register",
 *     tags={"Auth"},
 *     summary="Register API's",
 *     @OA\RequestBody(
 *          description= "- Register to your account",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="email", type="email"),
 *              @OA\Property(property="password", type="password"),
 *              @OA\Property(property="password_confirmation", type="password")
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Succesfully Login",
 *      ),
 *     @OA\Response(
 *         response=201,
 *         description="Succesfully Login",
 *      ),
 *      @OA\Response(
 *         response=419,
 *         description="Unauthorhized",
 *      ),
 *    )
 *
 * @return \Illuminate\Http\JsonResponse
 */
    public function register(Request $request) {

       $formField = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $formField['password'] = bcrypt($formField['password']);
        
        $user = User::create($formField);

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    
/**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/login",
 *     tags={"Auth"},
 *     summary="Login API's",
 *     @OA\RequestBody(
 *          description= "- Login to add products",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              required={"email","password"},
 *              @OA\Property(property="email", type="email"),
 *              @OA\Property(property="password", type="password")
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Succesfully Login",
 *      ),
 *     @OA\Response(
 *         response=201,
 *         description="Succesfully Login",
 *      ),
 *      @OA\Response(
 *         response=419,
 *         description="Unauthorhized",
 *      ),
 *    )
 *
 * @return \Illuminate\Http\JsonResponse
 */

    public function login(Request $request) {

        $formField = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $User = User::where('email', $formField['email'])->first();

        if (!$User || !Hash::check($formField['password'], $User->password)) {
            return response([
                'message' => 'Laksamana'
            ], 401);
        }

        $token = $User->createToken('myAppToken')->plainTextToken;

        $response = [
            'User' => $User,
            'token' => $token
        ];
        
        return response($response, 201);
    }
}
