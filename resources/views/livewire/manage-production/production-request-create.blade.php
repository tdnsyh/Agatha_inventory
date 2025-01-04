<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.alert />
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.request') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form wire:submit.prevent="saveProduction">
                                <div class="form-group">
                                    <label>Production Request ID</label>
                                    <input type="text" class="form-control" value="{{ $productionRequest->id }}"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label>Production Request By</label>
                                    <input type="text" class="form-control"
                                        value="{{ $productionRequest->user->full_name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Production Date</label>
                                    <input type="date" wire:model="production_date" class="form-control">
                                    @error('production_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Production Status</label>
                                    <select wire:model="production_status" class="form-control">
                                        <option value="In Progress">In Progress</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    @error('production_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea wire:model="note" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Shelf Name</label>
                                    <input type="text" wire:model="shelf_name" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Production</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-124">
                        <h3>Data Request Production</h3>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-detail-production">
                                <thead>
                                    <tr>
                                        <th>Code Product</th>
                                        <th>Name Product</th>
                                        <th>Variant Product</th>
                                        <th>Price Product</th>
                                        <th data-type="date">Expiration Day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->variant }}</td>
                                            <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ $product->expired_day }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('styles')
    <style>
        .dataTable-table {
            min-width: 1400px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        flatpickr('.flatpickr', {
            dateFormat: "d-m-Y",
            defaultDate: new Date(),
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-detail-production");
        });
    </script>
@endpush
