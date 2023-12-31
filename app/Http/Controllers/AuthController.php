<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class AuthController extends Controller
{
    //

        /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // return response()->json(auth()->attempt($validator->validated()));

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // return auth()->user();
         
        return $this->respondWithToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */


     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'f_name' => 'required|string|between:2,100',
             'l_name' => 'required|string|between:2,100',
             'username' => 'required|string|between:2,100',
             'email' => 'required|string|email|max:100|unique:users',
             'password' => 'required|string|min:6',
             'mobile' => 'required|string|between:10,12',
             'address' => 'required|string|between:2,200',
             'city' => 'required|string|between:2,100',
             'user_role' => 'required',
         ]);
 
         if ($validator->fails()) {
             return response()->json($validator->errors()->toJson(), 400);
         }
 
         // return response()->json(array_merge(
         //     $validator->validated(),
         //     ['password' => bcrypt($request->password)]
         // ));
 
         $user = User::create(array_merge(
             $validator->validated(),
             ['password' => bcrypt($request->password)]
         ));
 
         return response()->json([
             'message' => 'User successfully registered',
             'user' => $user
         ], 201);
     }



    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token){
        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL() * 60,
        //     'user' => auth()->user()
        // ]);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60
            // 'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
