<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="filterDate">
                        <div class="row g-3">
                            <div class="col-12 col-md-auto">
                                <input wire:model="startDate" class="form-control form-control-lg flatpickr" type="date"
                                    placeholder="Select Start Date">
                            </div>
                            <div class="col-12 col-md-auto">
                                <input wire:model="endDate" class="form-control form-control-lg flatpickr"
                                    type="date" placeholder="Select End Date">
                            </div>
                            <div class="col-12 col-md-auto">
                                <button type="submit" class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary">
                                    <i class="bi bi-journal-bookmark"></i> Generate Report
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Inventory Report</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a data-bs-toggle="tab" class="nav-link active" href="#report-inventory-in"
                                role="tab">Inventory [IN]</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a data-bs-toggle="tab" class="nav-link" href="#report-inventory-out"
                                role="tab">Inventory [OUT]</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Inventory IN Tab -->
                        <div class="tab-pane fade show active" id="report-inventory-in" role="tabpanel">
                            <div class="table-responsive mt-4">
                                <button id="exportInventoryInButton" class="btn icon icon-left mb-3 btn-success">
                                    <i class="bi bi-file-earmark-spreadsheet"></i> Export Inventory [IN]
                                </button>
                                <table class="table table-striped" id="table-inventory-in-report">
                                    <thead>
                                        <tr>
                                            <th>Batch Code</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Variant</th>
                                            <th>Price</th>
                                            <th>Shelf</th>
                                            <th>Initial</th>
                                            <th>Final</th>
                                            <th>Expiration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventoryIn as $report)
                                            <tr>
                                                <td>{{ $report->batch_code }}</td>
                                                <td>{{ $report->inventory_date }}</td>
                                                <td>{{ $report->product->name ?? 'No Product' }}</td>
                                                <td>{{ $report->product->variant ?? 'No Variant' }}</td>
                                                <td>{{ number_format($report->unit_price, 2) }}</td>
                                                <td>{{ $report->shelf_name }}</td>
                                                <td>{{ $report->initial_stock }}</td>
                                                <td>{{ $report->final_stock }}</td>
                                                <td>{{ \Carbon\Carbon::parse($report->expiration_date)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Inventory OUT Tab -->
                        <div class="tab-pane fade" id="report-inventory-out" role="tabpanel">
                            <div class="table-responsive mt-4">
                                <button id="exportInventoryOutButton" class="btn icon icon-left mb-3 btn-info">
                                    <i class="bi bi-file-earmark-spreadsheet"></i> Export Inventory [OUT]
                                </button>
                                <table class="table table-striped" id="table-inventory-out-report">
                                    <thead>
                                        <tr>
                                            <th>Batch Code</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Variant</th>
                                            <th>Price</th>
                                            <th>Shelf</th>
                                            <th>Initial</th>
                                            <th>Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventoryOut as $report)
                                            <tr>
                                                <td>{{ $report->batch_code }}</td>
                                                <td>{{ $report->inventory_date }}</td>
                                                <td>{{ $report->inventoryIn->product->name ?? 'No Product' }}</td>
                                                <td>{{ $report->inventoryIn->product->variant ?? 'No Variant' }}</td>
                                                <td>{{ number_format($report->unit_price, 2) }}</td>
                                                <td>{{ $report->shelf_name }}</td>
                                                <td>{{ $report->initial_stock }}</td>
                                                <td>{{ $report->stock_sold }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function getCurrentDate() {
                const today = new Date();
                const year = today.getFullYear();
                const month = (today.getMonth() + 1).toString().padStart(2, '0');
                const day = today.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            document.getElementById('exportInventoryInButton').addEventListener('click', function() {
                var wb = XLSX.utils.table_to_book(document.getElementById('table-inventory-in-report'), {
                    sheet: "Inventory In"
                });
                const currentDate = getCurrentDate();
                const fileName = `inventory_in_report_${currentDate}.xlsx`;

                XLSX.writeFile(wb, fileName);
            });

            document.getElementById('exportInventoryOutButton').addEventListener('click', function() {
                var wb = XLSX.utils.table_to_book(document.getElementById('table-inventory-out-report'), {
                    sheet: "Inventory Out"
                });
                const currentDate = getCurrentDate();
                const fileName = `inventory_out_report_${currentDate}.xlsx`;

                XLSX.writeFile(wb, fileName);
            });
        </script>
    </div>
</div>

@push('styles-priority')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
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
            initDataTable("table-inventory-in-report");
            initDataTable("table-inventory-out-report");
        });
    </script>
@endpush
