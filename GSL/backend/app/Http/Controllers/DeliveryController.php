<?php

// app/Http/Controllers/DeliveryController.php
namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Validator;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();
        return response()->json($deliveries);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'delivery_service_id' => 'required|exists:delivery_services,id',
            'deliverer_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'estimated_delivery' => 'required|date',
            'actual_delivery' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $delivery = Delivery::create($validator->validated());

        return response()->json([
            'message' => 'Delivery successfully created',
            'delivery' => $delivery
        ], 201);
    }

    public function show($id)
    {
        $delivery = Delivery::find($id);
        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }
        return response()->json($delivery);
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::find($id);
        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'package_id' => 'exists:packages,id',
            'delivery_service_id' => 'exists:delivery_services,id',
            'deliverer_id' => 'exists:users,id',
            'status' => 'string',
            'estimated_delivery' => 'date',
            'actual_delivery' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $delivery->update($validator->validated());

        return response()->json([
            'message' => 'Delivery successfully updated',
            'delivery' => $delivery
        ]);
    }

    public function destroy($id)
    {
        $delivery = Delivery::find($id);
        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }
        $delivery->delete();
        return response()->json(['message' => 'Delivery successfully deleted']);
    }
}
