<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
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
                        @if ($productions->isEmpty())
                            <p>No production records found.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Production ID</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productions as $production)
                                        <tr>
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
                                            <td>
                                                @if ($production->status == 'complete')
                                                    <a href="{{ route('inventory.request.show', $production->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @elseif ($production->status == 'waiting for response')
                                                    <a href="{{ route('inventory.request.show', $production->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('inventory.request.update', $production->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('inventory.request.show', $production->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($production->status == 'complete')
                                                    <button wire:click="approve({{ $production->id }})"
                                                        class="btn btn-info btn-sm">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                    <button wire:click="quantityMismatch({{ $production->id }})"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
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
