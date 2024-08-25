<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'full_name' => 'required|string|between:2,100',
            'role_id' => 'required|exists:roles,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password),
             'created_by' => Auth::id()]
        ));

        return response()->json([
            'message' => 'User successfully created',
            'user' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'string|between:2,100|unique:users,username,'.$id,
            'email' => 'string|email|max:100|unique:users,email,'.$id,
            'full_name' => 'string|between:2,100',
            'role_id' => 'exists:roles,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user->update(array_merge(
            $validator->validated(),
            ['updated_by' => Auth::id()]
        ));

        return response()->json([
            'message' => 'User successfully updated',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User successfully deleted']);
    }
}
