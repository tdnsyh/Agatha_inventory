<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="loadProductData">
                        <div class="row g-3">
                            <div class="col-12 col-md-auto">
                                <input class="form-control form-control-lg flatpickr" type="date" wire:model="startDate"
                                    placeholder="Select Start Date">
                            </div>
                            <div class="col-12 col-md-auto">
                                <input class="form-control form-control-lg flatpickr" type="date"
                                    wire:model="endDate" placeholder="Select End date">
                            </div>
                            <button type="submit" class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary">
                                <i class="bi bi-calculator"></i> Product Priority Analysis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-priority-analysis">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Variant</th>
                                    <th>Percentage of Amount</th>
                                    <th>Percentage of Sales</th>
                                    <th>Total Percentage</th>
                                    <th>Priority Group</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['product']->name }}</td>
                                        <td>{{ $product['product']->variant }}</td>
                                        <td>{{ number_format($product['percentageAmount'], 2) }}%</td>
                                        <td>{{ number_format($product['percentageQuantity'], 2) }}%</td>
                                        <td>{{ number_format($product['totalPercentage'], 2) }}%</td>
                                        <td>
                                            <span
                                                class="badge
                                            @if ($product['priorityGroup'] == 'A') bg-success
                                            @elseif($product['priorityGroup'] == 'B') bg-warning
                                            @else bg-danger @endif">
                                                {{ $product['priorityGroup'] }}
                                            </span>
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
