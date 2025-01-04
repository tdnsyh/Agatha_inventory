<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.create') }}">
                        <i class="bi bi-plus"></i>
                        Add Data Production
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-production">
                            <thead>
                                <tr>
                                    <th wire:click="sortBy('user_id')">User</th>
                                    <th>Production Request</th>
                                    <th wire:click="sortBy('production_date')" data-type="date">
                                        Production Date
                                        @if ($sortField === 'production_date')
                                            <i
                                                class="bi {{ $sortDirection === 'asc' ? 'bi-arrow-down' : 'bi-arrow-up' }}"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('production_status')">Production Status</th>
                                    <th>Total Product</th>
                                    <th>Note</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($productions as $production)
                                    <tr>
                                        <td>{{ $production->user->full_name }}</td>
                                        <td>PR-0{{ $production->production_request_id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($production->production_date)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $production->production_status }}</span>
                                        </td>
                                        <td>{{ $production->details->count() }}</td>
                                        <td>{{ $production->note ?? '-' }}</td>
                                        <td>
                                            <a class="btn icon icon-left btn-sm btn-info"
                                                href="{{ route('production.show', $production->id) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn icon icon-left btn-sm btn-warning"
                                                href="{{ route('production.update', $production->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $productions->links() }}
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
            min-width: 1200px !important;
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
