<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list()
    {
        return view('products.list');
    }
    
    public function create(Request $request)
    {
        return view('products.create');
    }
    
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product)
            return redirect()->route('products')->withErrors(__('Product does not exists'));
        
        return view('products.edit', ['product' => $product]);
    }
}
