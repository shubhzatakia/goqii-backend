<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();

            if ($users) {
                return response(['success' => true, 'count' => count($users), 'users' => $users], 200);
            } else {
                return response(['message' => 'Users not found'], 401);
            }
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required | min:2 | max:100',
                'email' => 'email | required ',
                'password' => 'required | min:2 | max:100',
                'dob' => 'required|date'

            ]);

            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->password = Hash::make($request->password);
            try {
                $user->save();
                return response(['success' => true, 'messages' => ['User Added Successfully'], 'user' => $user], 201);
            } catch (Exception $e) {
                return response(['error' => $e->getMessage()], 500);
            }

        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                return response(['message' => 'success', 'user' => $user], 200);
            } else {
                return response(['message' => 'User does not exist'], 404);
            }
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required | min:2 | max:100',
                'email' => 'email | required',
                'password' => 'required | min:2 | max:100',
                'dob' => 'date',
            ]);

            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }

            $user = User::find($id);
            if (!$user) {
                return response(['message' => 'User does not exist'], 404);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->save();

            return response(['success' => true, 'message' => 'User updated Successfully', 'user' => $user], 200);

        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 503);
        }

    }

   public function destroy($id)
    {
        try {
            $user = User::find($id);
            
            if ($user) {
                $user->delete();
                return response(['message' => 'User deleted successfully'], 200);
            } else {
                return response(['message' => 'User does not exist'], 204);
            }
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 401);
        }
    }
}
