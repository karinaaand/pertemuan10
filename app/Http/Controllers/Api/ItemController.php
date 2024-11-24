<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;



class ItemController extends Controller
{
    // Get all items
    public function index()
    {
        return response()->json(Item::all(), 200);
    }

    // Get single item
    public function show($id)
    {
        $item = Item::find($id);
        if ($item) {
            return response()->json($item, 200);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }

    // Create item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
        ]);

        $item = Item::create($validated);
        return response()->json($item, 201);
    }

    // Update item
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->update($request->only(['name', 'quantity']));
            return response()->json($item, 200);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }

    // Delete item
    public function destroy($id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Item deleted'], 200);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }
}
