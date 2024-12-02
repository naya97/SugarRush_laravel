<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|size:10|regex:/^09\d{8}$/',
            'password' => 'required|string|min:8|regex:/^[a-zA-Z0-9]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = Auth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $Token = $this->createNewToken($token);
        return response()->json([
            'message'=>'User successfully loggedin',
            'token' =>$Token,
    ]);
    }

    /* Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|between:2,100',
            'lastName' => 'required|string|between:2,100',
            'phone' => 'required|string|size:10|unique:users|regex:/^09\d{8}$/',
            'password' => 'required|string|confirmed|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
        ]);
    

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

    
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'token' =>Auth::login($user)
        ]);
   

}

    /* Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        try {
            Auth::logout();
            return response()->json(['message' => 'User successfully signed out']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    
    /* Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(Auth::refresh());
    }

    /* Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        $user = Auth::user();
        $profileData = [
            'firstName' => $user->firstName,
            'lastName' => $user->lastName,
            'phone' => $user->phone,
            'profile_image' => $user->image, 
            'location' => $user->location, 
        ];
    
        return response()->json($profileData);
    }
    
    public function editUserProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstName' => 'string|between:2,100',
            'lastName' => 'string|between:2,100',
            'phone' => 'string|size:10|unique:users|regex:/^09\d{8}$/',
            'old_password' => 'string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'password' => 'string|confirmed|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'location' => 'string',
            'image' => 'nullable|string'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
    
        $user = User::find(Auth::id());

        if($request->filled('password')){
            if(! $request->filled('old_password')){
                return response()->json(['message'=>'you have to enter old_password to change password']);
            }
            if(! Hash::check($request->old_password,$user->password)){
                return response()->json(['message'=>'old password is wrong']);
            }
        }
        $user->update($request->all());
        
        return response()->json(['message' => $this->userProfile()]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }

    
}
