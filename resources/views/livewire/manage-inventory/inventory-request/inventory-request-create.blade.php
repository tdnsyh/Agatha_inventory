<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <a class="btn icon icon-left btn-secondary mt-3" href="{{ route('inventory.request.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
            <div class="card mt-3">
                <div class="card-body">
                    <form wire:submit.prevent="submitRequest">
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select wire:model="product_id" class="form-control" id="product" required>
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->variant }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="request_date">Request Date</label>
                            <input type="date" wire:model="request_date" class="form-control" id="request_date"
                                required>
                            @error('request_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity_request">Quantity</label>
                            <input type="number" wire:model="quantity_request" class="form-control"
                                id="quantity_request" required>
                            @error('quantity_request')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="note">Note (optional)</label>
                            <textarea wire:model="note" class="form-control" id="note"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
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
