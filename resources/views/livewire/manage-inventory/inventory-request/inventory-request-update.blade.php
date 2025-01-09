<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.request.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Production Request</h4>
                </div>
                <div class="card-body">
                    <div class="col mb-3">
                        <label class="form-label">Request Date</label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($requestDate)->format('d-m-Y') }}" readonly>
                    </div>
                    @foreach ($details as $detail)
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="product-{{ $detail->id }}" class="form-label">Product</label>
                                <select id="product-{{ $detail->id }}" class="form-control"
                                    wire:model="selectedProductId.{{ $detail->id }}">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ $product->id == $detail->product_id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="quantity-{{ $detail->id }}" class="form-label">Quantity Produced</label>
                                <input type="number" id="quantity-{{ $detail->id }}" class="form-control"
                                    wire:model="selectedQuantity.{{ $detail->id }}">
                            </div>
                        </div>
                    @endforeach

                    <button class="btn btn-success mt-3" wire:click="updateDetails">Update Details</button>
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
