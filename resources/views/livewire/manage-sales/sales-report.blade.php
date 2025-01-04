<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-auto">
                            <input class="form-control form-control-lg flatpickr" type="date" wire:model="start_date"
                                placeholder="Select Start Date">
                        </div>
                        <div class="col-12 col-md-auto">
                            <input class="form-control form-control-lg flatpickr" type="date" wire:model="end_date"
                                placeholder="Select End date">
                        </div>
                        <a class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary" wire:click="generateReport">
                            <i class="bi bi-journal-bookmark"></i> Generate Sales Report
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title ?? 'Sales Report' }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-priority-analysis">
                            <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Variant</th>
                                    <th>Transaction Date</th>
                                    <th>Price Product</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    @foreach ($sale->details as $detail)
                                        <tr>
                                            <td>{{ $detail->product->code }}</td>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ $detail->product->variant }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sale->transaction_date)->format('d-m-Y') }}
                                            </td>
                                            <td>Rp. {{ number_format($detail->unit_price, 2) }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>Rp. {{ number_format($detail->sub_total, 2) }}</td>
                                        </tr>
                                    @endforeach
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

    <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('styles')
    <style>
        .dataTable-table {
            min-width: 1000px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        flatpickr('.flatpickr', {
            dateFormat: "d-m-Y",
            minDate: "01.01.2017",
            maxDate: "15.12.2018",
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-priority-analysis");
        });
    </script>
@endpush
