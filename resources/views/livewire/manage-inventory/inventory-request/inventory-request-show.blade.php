<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn icon icon-left btn-lg btn-primary"
                                href="{{ route('inventory.request.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Production Request Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Production Request Date</label>
                            <input class="form-control form-control-lg" type="text"
                                value="{{ \Carbon\Carbon::parse($productionRequest->request_date)->format('d-m-Y') }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Production Status Request</label>
                            <input class="form-control form-control-lg" type="text"
                                value="@if ($productionRequest->status_request == 'waiting for response') Waiting for Response
                                        @elseif($productionRequest->status_request == 'in progress') In Progress
                                        @elseif($productionRequest->status_request == 'pending approval') Pending Approval
                                        @elseif($productionRequest->status_request == 'approved') Approved
                                        @elseif($productionRequest->status_request == 'quantity mismatch') Quantity Mismatch @endif"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <input class="form-control form-control-lg" type="text"
                                value="{{ $productionRequest->note ?? '-' }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-detail-production">
                                        <thead>
                                            <tr>
                                                <th>Code Product</th>
                                                <th>Batch Code Production</th>
                                                <th>Name Product</th>
                                                <th>Variant Product</th>
                                                <th>Price Product</th>
                                                <th data-type="date">Expiration Date</th>
                                                <th>Stock Produced</th>
                                                <th data-sortable="false">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productionRequest->product->batchProductions as $batch)
                                                <tr>
                                                    <td>{{ $batch->product->code }}</td>
                                                    <td>{{ $batch->batch_code }}</td>
                                                    <td>{{ $batch->product->name }}</td>
                                                    <td>{{ $batch->product->variant }}</td>
                                                    <td>{{ 'Rp. ' . number_format($batch->product->price, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($batch->expiration_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $batch->stock_produced }}</td>
                                                    <td>
                                                        <a class="btn btn-primary" href="#">Show Barcode</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
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
