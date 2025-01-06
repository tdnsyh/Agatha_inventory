<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('product.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updateProduct">
                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="col">
                                <div class="form-group ">
                                    @if ($imagePath)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($imagePath) }}" class="img-fluid rounded">
                                        </div>
                                    @endif
                                    @if ($image)
                                        <div class="mt-2">
                                            <strong>Preview:</strong>
                                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded">
                                        </div>
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label for="image" class=" mt-3">Image</label>
                                    <input type="file" id="image" class="form-control" wire:model="image">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" id="code" class="form-control" wire:model="code"
                                        required>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" wire:model="name"
                                        required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="variant">Variant</label>
                                    <input type="text" id="variant" class="form-control" wire:model="variant">
                                    @error('variant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" id="price" class="form-control" wire:model="price"
                                        required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="expired_day">Expired Day</label>
                                    <input type="number" id="expired_day" class="form-control" wire:model="expired_day"
                                        required>
                                    @error('expired_day')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" id="stock" class="form-control" wire:model="stock"
                                        required>
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>
@endpush
