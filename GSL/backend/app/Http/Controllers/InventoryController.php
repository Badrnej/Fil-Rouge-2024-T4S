<?php

// app/Http/Controllers/InventoryController.php
namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class InventoryController extends Controller
{
    public function index()
    {
        $inventoryItems = Inventory::all();
        return response()->json($inventoryItems);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string',
            'quantity' => 'required|integer',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $inventoryItem = Inventory::create(array_merge(
            $validator->validated(),
            [
                'managed_by' => Auth::id(),
                'last_updated' => now()
            ]
        ));

        return response()->json([
            'message' => 'Inventory item successfully created',
            'inventory_item' => $inventoryItem
        ], 201);
    }

    public function show($id)
    {
        $inventoryItem = Inventory::find($id);
        if (!$inventoryItem) {
            return response()->json(['message' => 'Inventory item not found'], 404);
        }
        return response()->json($inventoryItem);
    }

    public function update(Request $request, $id)
    {
        $inventoryItem = Inventory::find($id);
        if (!$inventoryItem) {
            return response()->json(['message' => 'Inventory item not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'item_name' => 'string',
            'quantity' => 'integer',
            'location' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $inventoryItem->update(array_merge(
            $validator->validated(),
            [
                'managed_by' => Auth::id(),
                'last_updated' => now()
            ]
        ));

        return response()->json([
            'message' => 'Inventory item successfully updated',
            'inventory_item' => $inventoryItem
        ]);
    }

    public function destroy($id)
    {
        $inventoryItem = Inventory::find($id);
        if (!$inventoryItem) {
            return response()->json(['message' => 'Inventory item not found'], 404);
        }
        $inventoryItem->delete();
        return response()->json(['message' => 'Inventory item successfully deleted']);
    }
}
