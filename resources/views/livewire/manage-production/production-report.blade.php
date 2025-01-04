<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="generateReport">
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
                                <button type="submit" class="btn icon icon-left btn-lg btn-primary">
                                    <i class="bi bi-journal-bookmark"></i> Generate Production Report
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="col-auto">Production Report</h4>
                    <button id="exportExcel" class="btn btn-outline-success">Export to Excel</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-production-report">
                            <thead>
                                <tr>
                                    <th>Batch Code Production</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Variant</th>
                                    <th>Production Date</th>
                                    <th>Expiration Date</th>
                                    <th>Stock Produced</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productionReport as $report)
                                    <tr>
                                        <td>{{ $report->batch_code }}</td>
                                        <td>{{ $report->product->code }}</td>
                                        <td>{{ $report->product->name }}</td>
                                        <td>{{ $report->product->variant }}</td>
                                        <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report->expiration_date)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $report->quantity_produced }}</td>
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
<script>
    document.getElementById('exportExcel').addEventListener('click', function() {
        var table = document.getElementById('table-production-report');

        var wb = XLSX.utils.table_to_book(table, {
            sheet: "Production Report"
        });

        var now = new Date();
        var options = {
            timeZone: 'Asia/Jakarta',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
        };
        var formatter = new Intl.DateTimeFormat('en-GB', options);
        var formattedDateTime = formatter.format(now).replace(/[\s,:/]/g, '-');
        var fileName = `Production_Report_${formattedDateTime}.xlsx`;

        XLSX.writeFile(wb, fileName);
    });
</script>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
            initDataTable("table-production-report");
        });
    </script>
@endpush
