<?php

// app/Http/Controllers/DeliveryServiceController.php
namespace App\Http\Controllers;

use App\Models\DeliveryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class DeliveryServiceController extends Controller
{
    public function index()
    {
        $deliveryServices = DeliveryService::all();
        return response()->json($deliveryServices);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $deliveryService = DeliveryService::create(array_merge(
            $validator->validated(),
            ['created_by' => Auth::id()]
        ));

        return response()->json([
            'message' => 'Delivery service successfully created',
            'delivery_service' => $deliveryService
        ], 201);
    }

    public function show($id)
    {
        $deliveryService = DeliveryService::find($id);
        if (!$deliveryService) {
            return response()->json(['message' => 'Delivery service not found'], 404);
        }
        return response()->json($deliveryService);
    }

    public function update(Request $request, $id)
    {
        $deliveryService = DeliveryService::find($id);
        if (!$deliveryService) {
            return response()->json(['message' => 'Delivery service not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'description' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $deliveryService->update($validator->validated());

        return response()->json([
            'message' => 'Delivery service successfully updated',
            'delivery_service' => $deliveryService
        ]);
    }

    public function destroy($id)
    {
        $deliveryService = DeliveryService::find($id);
        if (!$deliveryService) {
            return response()->json(['message' => 'Delivery service not found'], 404);
        }
        $deliveryService->delete();
        return response()->json(['message' => 'Delivery service successfully deleted']);
    }
}
