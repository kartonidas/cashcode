<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Libraries\Api;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'metal', 'weight', 'change'];
    
    const METAL_AU = 'au';
    const METAL_AG = 'ag';
    const METAL_PT = 'pt';
    const METAL_PD = 'pd';
    
    public static function allowedMetals() : array
    {
        return [
            self::METAL_AU => __('Gold'),
            self::METAL_AG => __('Silver'),
            self::METAL_PT => __('Platinum'),
            self::METAL_PD => __('Palladium'),
        ];
    }
    
    public function getMetalName() : string
    {
        return self::allowedMetals()[$this->metal] ?? $this->metal;
    }
    
    private static $prices = [];
    public static function getPrices() : array
    {
        if(empty(static::$prices))
        {
            $api = new Api;
            static::$prices = $api->getPrices();
        }
        
        return static::$prices;
    }
    
    public function getPrice() : float
    {
        $prices = self::getPrices();
        if(!isset($prices[$this->metal]))
            throw new Exception(__('Invalid metal'));
        
        return $prices[$this->metal];
    }
    
    public function calculateBasePrice() : float
    {
        return round($this->weight * $this->getPrice(), 2);
    }
    
    public function calculateFinalPrice() : float
    {
        return round($this->calculateBasePrice() * (100 + $this->change)/100, 2);
    }
    
    public function calculateProfit() : float
    {
        return round($this->calculateFinalPrice() - $this->calculateBasePrice(), 2);
    }
}