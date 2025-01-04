<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('sales.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-lg-3">
                            <input class="form-control form-control-lg square" wire:model="scan_barcode" type="text"
                                placeholder="Input the Barcode or Scan the Barcode Code" autofocus>
                        </div>
                        <div class="col-12 col-md-2">
                            <input class="form-control form-control-lg" wire:model="quantity" type="number"
                                placeholder="Your Product Quantity" min="1">
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-lg btn-primary" wire:click="addProduct">Add To
                                List</button>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped" id="table-detail-production">
                            <thead>
                                <tr>
                                    <th>Code Product</th>
                                    <th>Name Product</th>
                                    <th>Variant Product</th>
                                    <th>Price Product</th>
                                    <th>Expiration Date</th>
                                    <th>Quantity</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $product['product_code'] }}</td>
                                        <td>{{ $product['product_name'] }}</td>
                                        <td>{{ $product['variant'] }}</td>
                                        <td>{{ number_format($product['unit_price'], 2) }}</td>
                                        <td>{{ \Carbon\Carbon::now()->addDays($product['expired_day'])->format('Y-m-d') }}
                                        <td>{{ $product['quantity'] }}</td>
                                        <td>
                                            <button class="btn icon icon-left btn-sm btn-danger"
                                                wire:click="removeProduct({{ $index }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="saveSale">
                        <div class="form-group">
                            <label class="form-label">Transaction Date</label>
                            <input class="form-control form-control-lg flatpickr" type="date"
                                wire:model="transaction_date" placeholder="Select Transaction Date">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Total Amount</label>
                            <input class="form-control form-control-lg" type="text" wire:model="total_amount"
                                placeholder="Total Amount" readonly>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save Sales</button>
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
