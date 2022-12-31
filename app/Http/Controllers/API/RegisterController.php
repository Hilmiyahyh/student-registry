<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        // INSERT REGISTRATION INFO INTO DATABASE
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::Create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        // VALIDATOR CHECK
        if ($validator) {
            return response()->json([
                // DISPLAY MESSAGE IF REGISTER OK
                'message' => 'Staff successfully registered!',
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
            ]);
        } else {
            // DISPLAY MESSAGE REGISTER ERROR
            return response()->json([
                'message' => 'Staff cannot be registered!',
            ]);
        }
    }

    public function login(Request $request){
        $credentials = request(['email', 'password']);
        
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'You are unauthorize to access this page!'
            ], 401);
        }
        $validator = $request->user();

        $tokenResult = $validator->createToken('MyApp');
        $token = $tokenResult->token;


        // if($request->remember_me){
        //     $token->expires_at = Carbon::now()->addWeek(1);
        // }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
                )->toDateString()
            ]);
    }

    // public function logout(Request $request){
    //     $token = $request->user()->token();
    //     $token->revoke();
    //     return response()->json([
    //         'message' => 'You have successfully logged out!',
    //     ]);
    // }


}
