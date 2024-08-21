<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;

use App\Models\Product;

class CreateProduct extends Component
{
    public $name = '';
    public $metal = '';
    public $weight = 0.01;
    public $change = 0;
    public $basePrice = 0;
    public $profit = 0;
    public $profitPrefix = '';
    public $finalPrice = 0;
    public Product|null $product = null;
    
    public function render()
    {
        return view('livewire.create-product');
    }
    
    public function save()
    {
        $validated = $this->validate($this->getValidateRule());
        
        if(!$this->product)
        {
            Product::create(
                $this->only(['name', 'metal', 'weight', 'change'])
            );
            session()->flash('status', __('Product successfully added.'));
        }
        else
        {
            $this->product->update(
                $this->only(['name', 'metal', 'weight', 'change'])
            );
            session()->flash('status', __('Product successfully updated.'));
        }
 
        return $this->redirect('/products');
    }
    
    public function mount(Product $product)
    {
        if($product->id)
        {
            $this->name = $product->name;
            $this->metal = $product->metal;
            $this->weight = $product->weight;
            $this->change = $product->change;
            
            $this->calculate();
            $this->product = $product;
        }
    }
    
    public function calculate()
    {
        $rule = $this->getValidateRule();
        unset($rule["name"]);
        $validated = $this->validate($rule);
        
        $this->basePrice = 0;
        $this->finalPrice = 0;
        $this->profit = 0;
        $this->profitPrefix = '';
        
        if(!empty($this->metal))
        {
            $prices = Product::getPrices();
            
            if(isset($prices[$this->metal]))
            {
                $this->basePrice = round($prices[$this->metal] * $this->weight, 2);
                $this->finalPrice = round($this->basePrice * (100 + $this->change)/100, 2);
                $this->profit = round($this->finalPrice - $this->basePrice, 2);
                
                if($this->profit > 0)
                    $this->profitPrefix = '+';
            }
        }
    }
    
    private function getValidateRule() : array
    {
        return [ 
            'name' => ['required', 'max:200'],
            'metal' => ['required', Rule::in(array_keys(Product::allowedMetals()))],
            'weight' => ['required', 'numeric', 'min:0.01'],
            'change' => ['required', 'numeric', 'min:0'],
        ];
    }
}
