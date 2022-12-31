<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
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

    // public function login(Request $request){
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    //         $user = Auth::user();
    //         $success['token'] =  $user->createToken('MyApp')-> accessToken;
    //         $success['name'] =  $user->name;

    // return $this->sendResponse($success, 'User login successfully.');
    // }
    // else{
    //     return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    // }
    // }
}
