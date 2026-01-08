<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $request)
    {
        // return apiSuccess("Account created successfuly",  compact('type' , 'name' ,'token' ), Response::HTTP_CREATED);

        // return $request;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|confirmed|min:6',
            'type' => 'required|in:tourist,provider',
            'name' => 'required|max:50',
            'DOB' => 'required_if:type,tourist|nullable|date',
            'gender' => 'required_if:type,tourist|nullable|in:M,F', 

            'country_id' => 'required_if:type,tourist|integer|exists:countries,id',
            'title' => 'required_if:type,provider|max:100',
            'description' => 'required_if:type,provider|max:500',
            'categories' => 'required_if:type,provider|array',
            'categories.*' => 'required_if:type,provider|exists:categories,id',
            'image_id' => 'required_if:type,provider|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'latitude' => 'required_if:type,provider|numeric',
            'longitude' => 'required_if:type,provider|numeric',
        ]);        

        $type = $request->type; 
        $name = $request->name; 
        
        if ($validator->fails())
            return apiError("invalid inputs", $validator->messages(),  Response::HTTP_UNPROCESSABLE_ENTITY);

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'type' => $type,
        ]);

        $token = $user->createToken("Api token")->plainTextToken;

        if ($type == 'tourist') {
            $user->tourist()->create([
                'name' => $request->name,
                'DOB' => $request->DOB,
                'gender'  => $request->gender,
                'country_id' => $request->country_id,
            ]);
            
        } else if ($type == 'provider') {            
            $provider = [
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,

                'image_id' =>  saveImg('provider', $request->file('image_id')),                
                'location' => DB::raw("POINT({$request->longitude}, {$request->latitude})"),                
            ];
                        
            $user->provider()->create($provider)->categories()->attach($request->categories);;
        }
        return apiSuccess("Account created successfuly",  compact('type' , 'name' ,'token' ), Response::HTTP_CREATED);
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return apiValidationError(errors: $validator->messages());

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $type = $user->type ; 

            $name = $type == 'provider'? $user->provider->name : ($type == 'tourist'? $user->tourist->name : 'admin' ) ; 
            $token = $user->createToken("web api")->plainTextToken;
            return apiSuccess("Account login successfuly", compact('type' , 'name' ,'token' ), Response::HTTP_CREATED);
        }
        
        return apiError("بيانات الدخول غير صحيحة");
    }

    function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return apiSuccess("logout ok");
    }
}
