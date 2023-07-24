<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Pagination\Paginator;


class ProductController extends Component
{
    use WithPagination;
    
    
    public function index()
    {
        
        return inertia('Product/Index',['products' => $this->getProducts()]);
    }

    public function getProducts()
    {
        return Product::paginate(10);
    }
}
