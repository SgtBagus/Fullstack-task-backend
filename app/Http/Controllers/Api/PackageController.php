<?php

namespace App\Http\Controllers\Api;

use DB;

use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageStoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller {
    public function index(){
        try {
            $package = Package::all();
    
            return response()->json([
                'data' => $package,
                'message' => "Success get Data"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }
    
    public function getActivePackage(){
        try {
            $package = DB::table('packages')
            ->select('*')
            ->where('status','=','true')
            ->get();
    
            return response()->json([
                'data' => $package,
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
            $packages = Package::find($id);
    
            if(!$packages){
                return response()->json([
                    'message' => 'Package not found'
                ],404);
            }
    
            return response()->json([
                'data' => $packages,
                'message' => "Success get Data",
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function create(PackageStoreRequest $request){
        try {
            //set validation
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'price'     => 'required',
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $package = Package::create([
                'name'      => $request->name,
                'desc'      => $request->desc,
                'price'     => $request->price,
                'status'    => $request->status,
            ]);

            return response()->json([
                'message'   => "Package successfully created",
                'success'   => true,
                'data'      => $package,  
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function update(PackageStoreRequest $request, $id){
        try {
            $packages = Package::find($id);
            if(!$packages){
                return $packages()->json([
                    'message' => 'Packages not found!'
                ],404);
            }

            $packages->name     = $request->name;
            $packages->desc     = $request->desc;
            $packages->price    = $request->price;
            $packages->status   = $request->status;
            
            $packages->save();

            return response()->json([
                'message' => 'Package successfully updated'
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ],500);
        }
    } 
        
    public function delete($id){

        $packages = Package::find($id);
        if(!$packages){
            return $packages()->json([
                'message' => 'Package not found!'
            ],404);
        }

        $packages->delete();

        return response()->json([
            'message' => 'Package succesfully deleted'
        ],200);
    }
}
