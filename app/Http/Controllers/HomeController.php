<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::whereAny([
            'name', 'description', 'price'], 'like', '%' . $request->search . '%')->get();
        return view('home', compact('products'));
    }
}
