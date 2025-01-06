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
            @if ($production)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Production Request Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Production ID:</strong></div>
                            <div class="col-md-9">{{ $production->id ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Inventory User ID:</strong></div>
                            <div class="col-md-9">{{ $production->inventoryUser->full_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Production User ID:</strong></div>
                            <div class="col-md-9">{{ $production->productionUser->full_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Production Date:</strong></div>
                            <div class="col-md-9">{{ $production->production_date ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Request Date:</strong></div>
                            <div class="col-md-9">{{ $production->request_date ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Status:</strong></div>
                            <div class="col-md-9"><span
                                    class="badge bg-{{ $production->status == 'complete'
                                        ? 'info'
                                        : ($production->status == 'in progress'
                                            ? 'warning'
                                            : ($production->status == 'waiting for response'
                                                ? 'secondary'
                                                : ($production->status == 'approved'
                                                    ? 'success'
                                                    : 'danger'))) }}">
                                    {{ $production->status }}
                                </span></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Note:</strong></div>
                            <div class="col-md-9">{{ $production->note ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3"><strong>Approval:</strong></div>
                            <div class="col-md-9">{{ $production->approval ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4>Detail Request</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th>Quantity Request</th>
                                    <th>Batch Code</th>
                                    <th>Shelf Name</th>
                                    <th>Expiration Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name ?? '-' }}</td>
                                        <td>{{ $detail->product->variant ?? '-' }}</td>
                                        <td>{{ $detail->quantity_produced ?? '-' }}</td>
                                        <td>{{ $detail->batch_code ?? '-' }}</td>
                                        <td>{{ $detail->shelf_name ?? '-' }}</td>
                                        <td>{{ $detail->expiration_date ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Production not found.</p>
            @endif
        </section>
    </div>
</div>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-detail-production");
        });
    </script>
@endpush
