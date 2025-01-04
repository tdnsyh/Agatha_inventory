<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.request.create') }}">
                <i class="bi bi-plus"></i>
                Add Request Production
            </a>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-request-production">
                            <thead>
                                <tr>
                                    <th>User</th>
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
                                        <td>{{ $request->user->full_name ?? 'N/A' }}</td>
                                        <td>{{ $request->product->name ?? 'N/A' }}</td>
                                        <td>{{ $request->quantity_request }}</td>
                                        <td>{{ \Carbon\Carbon::parse($request->request_date)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if ($request->status_request == 'Waiting For Response')
                                                <span class="badge bg-secondary">Waiting for Response</span>
                                            @elseif ($request->status_request == 'In Progress')
                                                <span class="badge bg-warning">In Progress</span>
                                            @elseif ($request->status_request == 'In Progress')
                                                <span class="badge bg-warning">In Progress</span>
                                            @elseif ($request->status_request == 'Complete')
                                                <span class="badge bg-success">Approved</span>
                                            @endif
                                        </td>
                                        <td>{{ $request->note ?? '-' }}</td>
                                        <td>
                                            @if ($request->status_request == 'Waiting For Response')
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('inventory.request.update', $request->id) }}"><i
                                                        class="bi bi-pencil"></i></a>
                                                <a class="btn btn-sm btn-danger" href="#"><i
                                                        class="bi bi-trash"></i></a>
                                            @elseif ($request->status_request == 'In Progress')
                                                <a class="btn icon icon-left btn-sm btn-info"
                                                    href="{{ route('inventory.request.show', $request->id) }}"><i
                                                        class="bi bi-eye"></i></a>
                                                <a class="btn icon icon-pencil btn-sm btn-warning"
                                                    href="{{ route('inventory.request.update-status', $request->id) }}"><i
                                                        class="bi bi-pencil"></i></a>
                                            @elseif ($request->status_request == 'in progress' || $request->status_request == 'approved')
                                                <a class="btn icon icon-left btn-sm btn-info"
                                                    href="{{ route('inventory.request.show', $request->id) }}"><i
                                                        class="bi bi-eye"></i></a>
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
            initDataTable("table-request-production");
        });
    </script>
@endpush
