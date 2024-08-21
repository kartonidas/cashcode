<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Api {
    private $endpoint = '/api/';
    
    public function getEndpoint(string $method) : string
    {
        return request()->root() . $this->endpoint . $method;
    }
    
    public function getPrices() : array
    {
        $prices = Cache::remember('prices', 300, function () {
            $response = Http::get($this->getEndpoint('prices'));
            return $response->json();
        });
        
        return $prices;
    }
}
