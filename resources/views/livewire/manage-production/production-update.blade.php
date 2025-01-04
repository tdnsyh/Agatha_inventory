<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updateProduction">
                        <div class="form-group">
                            <label class="form-label">Production Date</label>
                            <input class="form-control form-control-lg" type="date" wire:model="production_date">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Production Status</label>
                            <select class="form-select" wire:model="production_status">
                                <option value="">Select Status</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Complete">Complete</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <input class="form-control form-control-lg" type="text" wire:model="note">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Code Product</th>
                                    <th>Batch Code Production</th>
                                    <th>Name Product</th>
                                    <th>Variant Product</th>
                                    <th>Price Product</th>
                                    <th>Expiration Date</th>
                                    <th>Stock Produced</th>
                                    <th>Shelf Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->code }}</td>
                                        <td>{{ $detail->batch_code }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->variant }}</td>
                                        <td>{{ $detail->product->price ? 'Rp. ' . number_format($detail->product->price, 0, ',', '.') : 'Rp. 0' }}
                                        </td>
                                        <td>{{ $detail->expiration_date }}</td>
                                        <td>{{ $detail->quantity_produced }}</td>
                                        <td>{{ $detail->shelf_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
