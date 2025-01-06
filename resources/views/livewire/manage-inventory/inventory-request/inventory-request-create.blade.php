<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <a class="btn icon icon-left btn-secondary mt-3" href="{{ route('inventory.request.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

            <div class="mt-3">
                <form wire:submit.prevent="saveProduction">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="request_date" class="form-label">Request Date</label>
                                <input type="date" class="form-control" id="request_date" wire:model="request_date">
                                @error('request_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="products" class="form-label">Select Product</label>
                                <select wire:model="selectedProductId" class="form-control" id="products">
                                    <option value="">Select a Product</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} -
                                            {{ $product->variant }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedProductId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="selected_quantity" class="form-label">Quantity</label>
                                <input type="number" wire:model="selectedQuantity" class="form-control"
                                    id="selected_quantity" min="1">
                                @error('selectedQuantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="addProduct">
                                Add Product
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if (count($products) > 0)
                                <h4>Selected Products</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Variant</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $index => $product_id)
                                                <tr>
                                                    <td>{{ $allProducts->find($product_id)->name }}</td>
                                                    <td>{{ $allProducts->find($product_id)->variant }}</td>
                                                    <td>{{ $quantities[$index] }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            wire:click="removeProduct({{ $index }})">
                                                            Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-success">Save Production</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>

    <script>
        flatpickr('.flatpickr', {
            dateFormat: "d-m-Y",
            defaultDate: new Date(),
        })
    </script>
@endpush
