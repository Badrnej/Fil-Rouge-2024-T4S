<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return response()->json($packages);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'description' => 'required|string',
            'weight' => 'required|numeric',
            'dimensions' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $package = Package::create(array_merge(
            $validator->validated(),
            ['created_by' => Auth::id()]
        ));

        return response()->json([
            'message' => 'Package successfully created',
            'package' => $package
        ], 201);
    }

    public function show($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }
        return response()->json($package);
    }

    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'order_id' => 'exists:orders,id',
            'description' => 'string',
            'weight' => 'numeric',
            'dimensions' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $package->update($validator->validated());

        return response()->json([
            'message' => 'Package successfully updated',
            'package' => $package
        ]);
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }
        $package->delete();
        return response()->json(['message' => 'Package successfully deleted']);
    }
}
