<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        // if ($validator->fails()) {
        //     return redirect('post/create')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        $input = $request->all();
        $input ['password'] = bcrypt($input['password']);
        $user = User::Create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        // return $this->sendResponse($success, 'Registration Success!');
        
    }
}