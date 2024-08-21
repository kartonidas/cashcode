<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Product;

class ShowProducts extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.show-products', [
            'products' => Product::paginate(10)
        ]);
    }
    
    public function delete($id)
    {
        $product = Product::find($id);
        if($product)
            $product->delete();
    }
}
