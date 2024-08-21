<div>
     <form method="" action="post" wire:submit="save">
        <div class="row mb-3">
            <div class="col-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="my-2">{{ __('Information') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="inputName" class="form-label mb-0">{{ __('Product name') }}</label>
                            <input type="text" class="form-control" name="name" id="inputName" wire:model="name">
                            <div>
                                @error('name') <span class="error">{{ $message }}</span> @enderror 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="selectMetal" class="form-label mb-0">{{ __('Metal') }}</label>
                            <select class="form-control" name="metal" id="selectMetal" wire:model="metal" x-on:change="$wire.calculate()">
                                <option></option>
                                @foreach(\App\Models\Product::allowedMetals() as $metal => $metalName)
                                    <option value="{{ $metal }}">{{ $metalName }}</option>
                                @endforeach
                            </select>
                            <div>
                                @error('metal') <span class="error">{{ $message }}</span> @enderror 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputWeight" class="form-label mb-0">{{ __('Weight (g)') }}</label>
                            <input type="number" step="0.01" min="0.01" class="form-control" name="weight" id="inputWeight" wire:model="weight" x-on:keypress="$wire.calculate()" x-on:change="$wire.calculate()">
                            <div>
                                @error('weight') <span class="error">{{ $message }}</span> @enderror 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputChange" class="form-label mb-0">{{ __('Change (%)') }}</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="change" id="inputChange" wire:model="change" x-on:keypress="$wire.calculate()" x-on:change="$wire.calculate()">
                            <div>
                                @error('change') <span class="error">{{ $message }}</span> @enderror 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="my-2">{{ __('Calculation') }}</h3>
                    </div>
                    <div class="card-body lh-sm">
                        <div class="mb-3">
                            <label class="form-label mb-0">{{ __('Base price') }}</label>
                            <div class="fs-4 fw-bold">{{ Number::currency($basePrice, in: 'PLN', locale: 'pl') }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-0">{{ __('Change') }}</label>
                            <div class="fs-4 fw-bold">{{ $profitPrefix }}{{ Number::format($profit, locale: 'pl') }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-0">{{ __('Final price') }}</label>
                            <div class="fs-4 fw-bold">{{ Number::currency($finalPrice, in: 'PLN', locale: 'pl') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            @if(!empty($product->id))
                {{ __('Update product') }}
            @else
                {{ __('Add product') }}
            @endif
        </button>
    </form>
</div>
