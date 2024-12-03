<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Only authenticated admins can access
    }

    // Display a listing of products
    public function index()
    {
        $products = Product::all(); // Get all products
        return response()->json($products);
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'required|numeric',
            'current_price' => 'nullable|numeric',
            'admin_id' => 'required|exists:users,id',
            'bidding_ends_at' => 'nullable|date',
            'status' => 'required|in:active,sold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate image
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = null;
        }

        // Create product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'starting_price' => $validated['starting_price'],
            'current_price' => $validated['current_price'],
            'admin_id' => $validated['admin_id'],
            'bidding_ends_at' => $validated['bidding_ends_at'],
            'status' => $validated['status'],
            'image' => $imagePath, // Store image path
        ]);

        return response()->json($product, 201);
    }

    // Show the specified product
    public function show($id)
    {
        $product = Product::findOrFail($id); // Find the product by ID
        return response()->json($product);
    }

    // Update the specified product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'required|numeric',
            'current_price' => 'nullable|numeric',
            'bidding_ends_at' => 'nullable|date',
            'status' => 'required|in:active,sold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate image
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath; // Update image path
        }

        // Update the product details
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'starting_price' => $validated['starting_price'],
            'current_price' => $validated['current_price'],
            'bidding_ends_at' => $validated['bidding_ends_at'],
            'status' => $validated['status'],
        ]);

        return response()->json($product);
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the product image if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
