<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }
    public function edit(Product $product)
    {
        return view('admin.products-edit', compact('product'));
    }

    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'integer|nullable',
            'cover' => 'image|nullable',
            'description' => 'string|nullable',
        ]);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $validated['cover'] = $request->file('cover')->store('products', 'public');
            $product->cover = $validated['cover'];
        }

        $product->fill($validated);
        $product->save();
        return redirect()->route('admin.products');
    }

    public function create()
    {
        return view('admin.products-create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'integer|nullable',
            'cover' => 'image|nullable',
            'description' => 'string|nullable',
        ]);
        $validated['slug'] = str($validated['name'])->slug() . '-' . fake()->numberBetween(1, 10);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $validated['cover'] = $request->file('cover')->store('products', 'public');;
        }
        if($request->stock == null){
            $validated['stock'] = 0;
        }

        Product::create($validated);
        return redirect()->route('admin.products');
    }

}
