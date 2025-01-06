<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select" wire:model="status">
                                <option value="">All</option>
                                <option value="waiting for response">Waiting for Response</option>
                                <option value="in progress">In Progress</option>
                                <option value="complete">Complete</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" id="start_date" class="form-control" wire:model="start_date" />
                        </div>

                        <div class="col-md-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" id="end_date" class="form-control" wire:model="end_date" />
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary" wire:click="loadProductions">Filter</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-success" id="downloadExcel">Download Excel</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="production-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Production ID</th>
                                    <th>Status</th>
                                    <th>Production Date</th>
                                    <th>Request Date</th>
                                    <th>Note</th>
                                    <th>Batch Code</th>
                                    <th>Shelf Name</th>
                                    <th>Quantity Produced</th>
                                    <th>Expiration Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $production)
                                    @foreach ($production->details as $detail)
                                        <tr>
                                            <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                                            <td>{{ $production->id }}</td>
                                            <td>{{ ucfirst($production->status) }}</td>
                                            <td>{{ $production->production_date }}</td>
                                            <td>{{ $production->request_date }}</td>
                                            <td>{{ $production->note }}</td>
                                            <td>{{ $detail->batch_code }}</td>
                                            <td>{{ $detail->shelf_name }}</td>
                                            <td>{{ $detail->quantity_produced }}</td>
                                            <td>{{ $detail->expiration_date }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($productions->isEmpty())
                <p>No records found for the selected filters.</p>
            @endif
        </section>
    </div>
</div>
<script>
    document.getElementById('downloadExcel').addEventListener('click', function() {
        let table = document.querySelector('table');
        let wb = XLSX.utils.table_to_book(table, {
            sheet: "Production Report"
        });

        let currentDate = new Date();
        let formattedDate = currentDate.toISOString().split('T')[0];

        let fileName = 'Production_Report_' + formattedDate + '.xlsx';

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
