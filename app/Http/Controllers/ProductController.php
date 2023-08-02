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
        $validated = $request->validate([
            'title' => 'required|max:191',
            'des' => 'required|max:255',
            'img' => 'required',
        ]);

        // dd($request->all());
       $product = new Product();
       $product->title = $request->title;
       $product->des = $request->des;
       $product->addMediaFromRequest('img')->toMediaCollection('img');
       $product->save();

       return redirect()->route('products.index')
            ->with('message', 'Product Added Successfully');
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
        $validated = $request->validate([
            'title' => 'required|max:191',
            'des' => 'required|max:255',
            
        ]);

        $product = Product::findOrFail($id);
        if($request->img != null) {
            $product->media[0]->delete();
            $product->addMediaFromRequest('img')->toMediaCollection('img');
        }
        $product->title = $request->title;
        $product->des = $request->des;
        $product->update();
        return redirect()->route('products.index')
            ->with('message', 'Product Updated Successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('message', 'Product Deleted Successfully');

    }
}
