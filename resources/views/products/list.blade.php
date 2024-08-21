@extends('layouts.app')

@section('content')
    <div class="border-bottom">
        <div class="container d-flex justify-content-between align-items-center mb-3">
            <h2 class="m-0">{{ __("Products") }}</h2>
            <div>
                <a href="{{ route("product.create") }}" class="btn btn-primary btn-sm">{{ __("Add product") }}</a>
            </div>
        </div>
    </div>
    <div class="container pt-3">
        @include("partials.messages")
        <livewire:show-products />
    </div>
@endsection