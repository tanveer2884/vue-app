<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use WithSaveImages;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $products = Product::with('media')->latest()->paginate(10);
       
        return Inertia('Product/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $product = new Product();
       $product->title = $request->title;
       $product->des = $request->des;
       $product->addMediaFromRequest('img')->toMediaCollection('img');
       $product->save();

       return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('media')->findOrFail($id);
        
        return Inertia('Product/Edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        if(count($product->media) > 0) {
            $product->media[0]->delete();
        }
        $product->title = $request->title;
        $product->des = $request->des;
        $product->addMediaFromRequest('img')->toMediaCollection('img');
        $product->update();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index');

    }
}
