<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('sales.create') }}">
                        <i class="bi bi-plus"></i>
                        Add Data Sales
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-sales">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Total Product</th>
                                        <th>Total Amount</th>
                                        <th data-type="date">Transaction Date</th>
                                        <th data-sortable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{ $sale->user->full_name }}</td>
                                            <td>{{ $sale->details->sum('quantity') }}</td>
                                            <td>Rp. {{ number_format($sale->total_amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sale->transaction_date)->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                <a class="btn icon icon-left btn-sm btn-info"
                                                    href="{{ route('sales.show', $sale->id) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a class="btn icon icon-left btn-sm btn-warning"
                                                    href="{{ route('sales.update', $sale->id) }}">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </td>
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
    <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('styles')
    <style>
        .dataTable-table {
            min-width: 900px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-sales");
        });
    </script>
@endpush
