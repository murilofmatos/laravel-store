<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }
    public function edit()
    {
        return view('admin.products-edit');
    }

    public function update(Request $request)
    {
        $product = Product::find($request->slug);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->cover = $request->cover;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
    }

    public function create()
    {
        return view('admin.products-create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'nullable',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',
        ]);
        $validated['slug'] = str($validated['name'])->slug() . '-' . fake()->numberBetween(1, 10);
        Product::create($validated);
        return redirect()->route('admin.products');
    }

}
