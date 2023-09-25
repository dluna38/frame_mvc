<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserControllerApi extends Controller{

    use ApiResponse;

    public function store(Request $request){
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol'=>User::ROLES["USER"]
        ]);

        return $this->sucessResponse(['token' => $this->createToken($result)]);
    }

    public function storeAdmin(Request $request){
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol'=>User::ROLES["ADMIN"]
        ]);

        return $this->sucessResponse(['token' => $this->createToken($result)]);
    }

    public function logIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->errorResponse([],400,"The provided credentials are incorrect.");
        }
    
        return $this->sucessResponse(['token' => $this->createToken($user)]);
    }

    private function createToken(User $user,array $abilities = []){
        array_push($abilities, $user->rol);
        return $user->createToken($user->email,$abilities)->plainTextToken;
    }

    public function logOut(Request $request){
        /*         // Revoke all tokens...
        $user->tokens()->delete();
        
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
        
        // Revoke a specific token...
        $user->tokens()->where('id', $tokenId)->delete(); */

        $request->user()->currentAccessToken()->delete();
        return $this->sucessResponse([],200,"log out OK");
    }
    public function funTest(Request $request){
        return "test";
    }
}