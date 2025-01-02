<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="col-auto">{{ $title }} Datatable</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table-production">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Quantity Request</th>
                                    <th data-type="date">Production Request Date</th>
                                    <th>Status Request</th>
                                    <th>Note</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productionRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->full_name }}</td>
                                        <td>{{ $request->product->code }}</td>
                                        <td>{{ $request->product->name }}</td>
                                        <td>{{ $request->quantity_request }}</td>
                                        <td>{{ \Carbon\Carbon::parse($request->production_date)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $this->getStatusBadgeClass($request->status_request) }}">
                                                {{ $request->status_request }}
                                            </span>
                                        </td>
                                        <td>{{ $request->note ?? '-' }}</td>
                                        <td>
                                            @if ($request->status_request == 'Approved')
                                                <a class="btn icon icon-left btn-sm btn-info"
                                                    href="{{ route('production.show', $request->id) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('production.request.create', ['productionRequestId' => $request->id]) }}">
                                                    Make Production
                                                </a>
                                            @endif
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
            min-width: 1400px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-production");
        });
    </script>
@endpush
