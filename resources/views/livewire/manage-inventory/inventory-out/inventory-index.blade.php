<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-inventory-out-report">
                            <thead>
                                <tr>
                                    <th>Batch Code</th>
                                    <th data-type="date">Date</th>
                                    <th>Name</th>
                                    <th>Variant</th>
                                    <th>Price</th>
                                    <th>Shelf</th>
                                    <th>Initial</th>
                                    <th>Sold</th>
                                    <th>Expiration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventoryOuts as $inventoryOut)
                                    <tr>
                                        <td>{{ $inventoryOut->batch_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inventoryOut->inventory_date)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $inventoryOut->inventoryIn->product->name }}</td>
                                        <td>{{ $inventoryOut->inventoryIn->product->variant }}</td>
                                        <td>Rp. {{ number_format($inventoryOut->unit_price, 2, ',', '.') }}</td>
                                        <td>{{ $inventoryOut->shelf_name }}</td>
                                        <td>{{ $inventoryOut->initial_stock }}</td>
                                        <td>{{ $inventoryOut->stock_sold }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inventoryOut->inventoryIn->expiration_date)->format('d-m-Y') }}
                                        </td>
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

@push('styles')
    <style>
        .dataTable-table {
            min-width: 1500px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-inventory-out-report");
        });
    </script>
@endpush
