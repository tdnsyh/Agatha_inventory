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
                    <form wire:submit.prevent="saveProduction">
                        <div class="form-group">
                            <label class="form-label">Production Request</label>
                            <select class="choices form-select" wire:model="production_request_id">
                                <option value="">Select Your Request</option>
                                @foreach ($productionRequests as $request)
                                    <option value="{{ $request->id }}">
                                        User : {{ $request->user_id }} |
                                        Request Date: {{ $request->request_date }} |
                                        Product Name: {{ $request->product->name }} |
                                        Quantity: {{ $request->quantity_request }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Production Status</label>
                            <select class="choices form-select" wire:model="production_status">
                                <option value="">Select Your Status</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Complete">Complete</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <input class="form-control form-control-lg" type="text" wire:model="note"
                                placeholder="Your Note">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Production Date</label>
                            <input class="form-control form-control-lg flatpickr" type="date"
                                wire:model="production_date" placeholder="Select Production Date">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Shelf name</label>
                            <input class="form-control form-control-lg" type="text" wire:model="shelf_name"
                                placeholder="Shelf Name">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save Production</button>
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
