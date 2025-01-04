<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
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
                    <form wire:submit.prevent="updateRequest">
                        <!-- Request Date -->
                        <div class="form-group">
                            <label class="form-label">Request Date</label>
                            <input class="form-control flatpickr" type="date" wire:model="request_date">
                            @error('request_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product</label>
                            <select class="form-select" wire:model="product_id">
                                <option value="" selected>Select Your Product</option>
                                @foreach (\App\Models\Products::all() as $product)
                                    <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input class="form-control" type="number" wire:model="quantity_request"
                                placeholder="Your Quantity">
                            @error('quantity_request')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
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
