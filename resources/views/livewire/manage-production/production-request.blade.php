<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Inventory User</th>
                                    <th>Request ID</th>
                                    <th>Request Date</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $production)
                                    <tr>
                                        <td>{{ $production->inventoryUser->full_name ?? 'N' }}</td>
                                        <td>{{ $production->id }}</td>
                                        <td>{{ $production->request_date }}</td>
                                        <td><span
                                                class="badge bg-{{ $production->status == 'complete'
                                                    ? 'info'
                                                    : ($production->status == 'in progress'
                                                        ? 'warning'
                                                        : ($production->status == 'waiting for response'
                                                            ? 'secondary'
                                                            : ($production->status == 'approved'
                                                                ? 'success'
                                                                : 'danger'))) }}">
                                                {{ $production->status }}
                                            </span></td>
                                        <td>{{ $production->note }}</td>
                                        <td>
                                            @if ($production->status == 'waiting for response')
                                                <a href="{{ route('production.request.create', $production->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-play-circle"></i>
                                                </a>
                                                <a href="{{ route('production.show', $production->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('production.show', $production->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i>
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
