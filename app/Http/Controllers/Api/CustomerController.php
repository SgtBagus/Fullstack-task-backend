<?php

namespace App\Http\Controllers\Api;

use DB;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller {
    public function index(){
        try {
            $customer = DB::table('customers')->select(
                'customers.id as id',
                'customers.name as customerName',
                'customers.phone as customerPhone',
                'customers.address as customerAddress',
                'customers.status as customerStatus',
                'customers.ktpImage as customerKtpImage',
                'customers.houseImage as customerHouseImage',
                'packages.id as packageId',
                'packages.name as packageName',
                'packages.desc as packageDesc',
                'packages.price as packageDesc',
                'users.name as createdName',
                'users.role as createdRole'
            )->join(
                'packages',
                'customers.package_id','=','packages.id',
            )->join(
                'users',
                'customers.created_by','=','users.id',
            )->groupBy('customers.id')->get();
    
            return response()->json([
                'data' => $customer,
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
            $customer = Customer::find($id);
    
            if(!$customer){
                return response()->json([
                    'message' => 'Customer not found'
                ], 404);
            }
    
            return response()->json([
                'data' => $customer,
                'message' => "Success get Data"
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function create(CustomerStoreRequest $request){
        try {
            //set validation
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'phone'         => 'required',
                'address'       => 'required',
                'status'        => 'required',
                'package_id'     => 'required',
                'ktpImage'      => 'required',
                'houseImage'    => 'required',
                'created_by'     => 'required',
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $customer = Customer::create([
                'name'          => $request->name,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'status'        => $request->status,
                'package_id'    => $request->package_id,
                'ktpImage'      => $request->ktpImage,
                'houseImage'    => $request->houseImage,
                'created_by'    => $request->created_by,
            ]);

            return response()->json([
                'message'   => "Package successfully created",
                'success'   => true,
                'data'      => $customer,  
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ], 500);
        }
    }

    public function update(CustomerStoreRequest $request, $id){
        try {
            $customer = Customer::find($id);
            if(!$customer){
                return $customer()->json([
                    'message' => 'Customer not found!'
                ], 404);
            }

            $customer->name         = $request->name;
            $customer->phone        = $request->phone;
            $customer->address      = $request->address;
            $customer->status       = $request->status;
            $customer->package_id   = $request->package_id;
            $customer->ktpImage     = $request->ktpImage;
            $customer->houseImage   = $request->houseImage;
            $customer->created_by   = $request->created_by;
            
            $customer->save();

            return response()->json([
                'message' => 'Customer successfully updated'
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ],500);
        }
    } 

    public function updatestatus(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'status'     => 'required',
            ]);

            $customer = Customer::find($id);
            if(!$customer){
                return $customer()->json([
                    'message' => 'Customer not found!'
                ], 404);
            }

            $customer->status = $request->status;
            
            $customer->save();

            return response()->json([
                'message' => 'Customer successfully updated'
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!"
            ],500);
        }
    }

    public function delete($id){

        $customer = Customer::find($id);
        if(!$customer){
            return $customer()->json([
                'message' => 'Package not found!'
            ],404);
        }

        $customer->delete();

        return response()->json([
            'message' => 'Customer succesfully deleted'
        ],200);
    }
}
