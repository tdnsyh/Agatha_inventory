<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <form wire:submit.prevent="save">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Production</h3>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="production_id" class="form-label">ID Request</label>
                                    <input type="text" class="form-control" id="production_id"
                                        value="{{ $production->id }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="inventory_user_id" class="form-label">Inventory User ID</label>
                                    <input type="text" class="form-control" id="inventory_user_id"
                                        value="{{ $production->inventory_user_id }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="production_user_id" class="form-label">Production User ID</label>
                                    <input type="text" class="form-control" id="production_user_id"
                                        value="{{ $production_user_id }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="request_date" class="form-label">Request Date</label>
                            <input type="date" class="form-control" id="request_date"
                                value="{{ $production->request_date }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select" wire:model="status">
                                <option value="" selected>Select a status</option>
                                <option value="in progress">In Progress</option>
                                <option value="complete">Complete</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shelf_name" class="form-label">Shelf Name</label>
                            <input type="text" id="shelf_name" class="form-control" wire:model="shelf_name"
                                value="{{ $shelf_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="production_date" class="form-label">Production Date</label>
                            <input type="date" class="form-control" wire:model="production_date">
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" wire:model="note"></textarea>
                        </div>
                        <div class="btr">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            @if (session()->has('error'))
                <div class="alert alert-success mt-3">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card mt-4">
                <div class="card-body">
                    <h4>Detail Request Production</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th>Batch Code</th>
                                    <th>Shelf Name</th>
                                    <th>Quantity Produced</th>
                                    <th>Expiration Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->variant }}</td>
                                        <td>{{ $detail->batch_code }}</td>
                                        <td>{{ $detail->shelf_name }}</td>
                                        <td>{{ $detail->quantity_produced }}</td>
                                        <td>{{ $detail->expiration_date }}</td>
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
