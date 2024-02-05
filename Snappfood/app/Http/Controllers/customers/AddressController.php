<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    private static $user;

    public function __construct()
    {
        $this::$user = auth()->guard('sanctum')->user();
    }
    private function sendErrorResponse($errors, $status = 422)
    {
    return response()->json(['errors' => $errors], $status);
    }

    public function getUserAddress()
    {


        $addresses = $this::$user->customer->customerAddresses;

        $addressData = AddressResource::collection($addresses);

        return response()->json($addressData);
    }

    public function addAddress(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ];

            $validatedData = $request->validate($rules);

            CustomerAddress::create([
                'address_title' => $validatedData['title'],
                'address' => $validatedData['address'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'is_default' => false,
                'customer_id' => $this::$user->customer->id
            ]);


            return response()->json(['msg' => 'address added successfully']);
        } catch (ValidationException $e) {
            // Return JSON response with validation errors
            return $this->sendErrorResponse($e->errors(), $e->status);
        }
    }

    public function updateAddress(string $id)
    {

        try {
            $customerId = optional($this::$user->customer)->id;

            if (!$customerId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $address = Cache::remember("customer_address_{$id}", 60, function () use ($id) {
                return CustomerAddress::find($id);
            });

            if ($address == null) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            if ($address->customer_id != $customerId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            } else {

                CustomerAddress::where('customer_id', $customerId)
                    ->where('is_default', true)
                    ->update([
                        'is_default' => false
                    ]);


                $address->update([
                    'is_default' => true
                ]);


                Cache::forget("customer_address_{$id}");

                return response()->json(['msg' => 'Current address updated successfully']);
            }
        } catch (\Exception) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }


    }


}
