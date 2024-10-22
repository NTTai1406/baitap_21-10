<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user= new User();
        $user->name= request('name');
        $user->email= request('email');
        $user->password= Hash::make(request('password'));

        $user->save();

        return response()->json(['message'=>'User registered Successfully'],201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user= User::where('email',$request->email)->first();
        if(!$user || !Hash::check(request('password'),$user->password)){
            return response()->json(['message'=>'invalid email or password'],401);
        }
        else{
            return response()->json(['message'=>'User Login Successfully'],200);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|sometimes',
            'email' => 'required|sometimes',
            'password' => 'required|sometimes',
        ]);
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return response()->json($user);
        }else{
            return response()->json(['message'=>'User updated failed'],401);
        }
    }

    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(['message'=>'User deleted Successfully']);
        }
        else{
            return response()->json(['message'=>'User not found'],404);
        }
    }

    public function search($name){
        $users = User::where('name', 'like', '%' . $name . '%')->get();
        return response()->json($users);
    }
}
