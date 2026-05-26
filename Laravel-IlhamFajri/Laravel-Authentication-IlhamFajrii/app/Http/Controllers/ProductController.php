<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = Product::latest();
        
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }
        
        $products = $query->get();

        return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required',
            'stock' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,habis',
            'description' => 'nullable',
        ]);

        Product::create($validated);

        return redirect('/products')->with('success', 'Produk berhasil ditambah');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required',
            'stock' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,habis',
            'description' => 'nullable',
        ]);

        $product->update($validated);

        return redirect('/products')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products')->with('success', 'Produk berhasil dihapus');
    }
}