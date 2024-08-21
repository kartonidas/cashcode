<div>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Metal') }}</th>
                <th>{{ __('Weight (g)') }}</th>
                <th>{{ __('Base price') }}</th>
                <th>{{ __('Change') }}</th>
                <th>{{ __('Final price') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->id }}</td>
                    <td class="align-middle">{{ $product->name }}</td>
                    <td class="align-middle">{{ $product->getMetalName() }}</td>
                    <td class="align-middle">{{ Number::format($product->weight, locale: 'pl') }}</td>
                    <td class="align-middle">{{ Number::currency($product->calculateBasePrice(), in: 'PLN', locale: 'pl') }}</td>
                    <td class="align-middle">
                        @if($product->change > 0){{ '+' }}@endif{{ Number::format($product->change, locale: 'pl') }}%
                        <div>
                            ({{ Number::currency($product->calculateProfit(), in: 'PLN', locale: 'pl') }})
                        </div>
                    </td>
                    <td class="align-middle">{{ Number::currency($product->calculateFinalPrice(), in: 'PLN', locale: 'pl') }}</td>
                    <td class="align-middle">
                        <a href="{{ route('product.edit', $product->id) }}">{{ __('Edit') }}</a>
                        <br/>
                        <a href="#!" wire:click="delete({{ $product->id }})" wire:confirm="{{ __('Are you sure you want to delete this product?') }}" class="text-danger">{{ __('Delete') }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
    {!! $products->links() !!}
</div>
