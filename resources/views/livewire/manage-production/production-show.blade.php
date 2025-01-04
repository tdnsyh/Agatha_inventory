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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Request Production From</label>
                                <input class="form-control form-control-lg" type="text"
                                    value="{{ $production->productionRequest->user->full_name }}" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Reference Request Production ID</label>
                                <input class="form-control form-control-lg" type="number"
                                    value="{{ $production->production_request_id }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Production Date</label>
                        <input class="form-control form-control-lg" type="text"
                            value="{{ \Carbon\Carbon::parse($production->production_date)->format('d-m-Y') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Production Status</label>
                        <input class="form-control form-control-lg" type="text"
                            value="{{ $production->production_status }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Note</label>
                        <input class="form-control form-control-lg" type="text"
                            value="{{ $production->note ?? '-' }}" readonly>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
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
                                    <th>Shelf Name</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->product ? $detail->product->code : 'No Code' }}</td>
                                        <td>{{ $detail->batch_code }}</td>
                                        <td>{{ $detail->product ? $detail->product->name : '-' }}</td>
                                        <td>{{ $detail->product ? $detail->product->variant : '-' }}</td>
                                        <td>{{ $detail->product && $detail->product->price ? 'Rp. ' . number_format($detail->product->price, 0, ',', '.') : 'Rp. 0' }}
                                        </td>
                                        <td>{{ $detail->expiration_date }}</td>
                                        <td>{{ $detail->quantity_produced }}</td>
                                        <td>{{ $detail->shelf_name ?? '-' }}</td>
                                        <td><a class="btn btn-primary" href="#">Show Barcode</a></td>
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
