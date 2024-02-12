<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(){
        try {
            $users = User::all();
    
            return response()->json([
                'data' => $users,
                'message' => "Success get Data"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }
    

    public function show($id){
        try {
            $users = User::find($id);
    
            if(!$users){
                return response()->json([
                    'message' => 'user not found'
                ],404);
            }
    
            return response()->json([
                'data' => $users,
                'message' => "Success get Data"
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function create(UserStoreRequest $request){
        try {
            //set validation
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'required|min:8|confirmed'
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors(),
                    'message' => "Something went wrong!",
                ], 500);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password'  => bcrypt($request->password),
                'image' => $request->image,
                'role' => $request->role,
            ]);

            return response()->json([
                'message' => "User successfully created",
                'success' => true,
                'data'    => $user,  
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'email'     => 'required|email|unique:users',
                'role'     => 'required',
            ]);

            $users = User::find($id);
            if(!$users){
                return $users()->json([
                    'message' => 'User not found!'
                ],404);
            }

            $users->name = $request->name;
            $users->email = $request->email;
            $users->image = $request->image;
            $users->role = $request->role;
            
            $users->save();

            return response()->json([
                'message' => 'User successfully updated'
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ],500);
        }
    } 
        
    public function delete($id){

        $users = User::find($id);
        if(!$users){
            return $users()->json([
                'message' => 'User not found!'
            ],404);
        }

        $users->delete();

        return response()->json([
            'message' => 'user succesfully deleted'
        ],200);
    }
}
