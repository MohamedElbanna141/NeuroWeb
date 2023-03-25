<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;


class AuthController extends Controller
{
    public function register_one(Request $request)
    {
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "password" => "required|string"
        ]);

        /*$file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images', $filename);*/

        $user = User::create([
            "name" => $fields['name'],
            "email" => $fields['email'],
            "password" => bcrypt($fields['password']),
            //"image" => $filename,
            
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status' => TRUE,
            'message'=> 'تم التسجيل بنجاح',
            'user' => $user,
            'token' => $token
        ];

        
        return response($response, 201);
    }


    public function login_one(Request $request)
    {
        $fields = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'status' => FALSE,
                'message' => 'فشل تسجيل الدخول'
            ],401);
        };

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status' => TRUE,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => $user,
            'token' => $token
        ];

        
        return response($response, 201);
    }


    /*............................................................................. */
   /* public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "password" => "required|string"
        ]);

        $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
            
        ]);

        $user->save();
        return response()->json(["message" => "user saved"],200);
    }*/

    /*public function login(Request $request){

        $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $credentials = request(['email' , 'password']);

        if(!Auth::attempt($credentials)){
            return response()->jason(["message" => "unauthhorized"],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult;
        $token->expires_at = Carbon::now()->addweeks(1);
        $token->save();

        return response()->jason(["data" =>[ 
            'user' => Auth::user(),
            'access_token' => $tokenResult->accessToken,

        ]],200);

    } */   
}
