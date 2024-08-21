@extends('layouts.app')

@section('content')
    <div class="border-bottom">
        <div class="container d-flex align-items-center mb-3">
            <a href="{{ route('products') }}" class="me-3">
                <i class="bi bi-arrow-bar-left fs-4 text-dark"></i>
            </a>
            <h2 class="m-0">{{ __('Edit product') }}</h2>
        </div>
    </div>
    <div class="container pt-3">
       <livewire:create-product :product="$product"/>
    </div>
@endsection