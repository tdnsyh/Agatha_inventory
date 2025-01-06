<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Product</h5>
                            <h1 class="card-text">{{ $totalProducts }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Transaction</h5>
                            <h1 class="card-text">Rp. {{ number_format($totalTransactions, 0, ',', '.') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total User</h5>
                            <h1 class="card-text">{{ $totalUsers }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sales Chart -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sales Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Production Chart -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Production Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="productionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Latest Sales</h4>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('sales.index') }}">More
                                    Info</a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-striped" id="table-sales">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th data-type="date">Date</th>
                                            <th>Total</th>
                                            <th data-sortable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestSales as $sale)
                                            <tr>
                                                <td>{{ $sale->user->full_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sale->transaction_date)->format('d-m-Y') }}
                                                </td>
                                                <td>Rp. {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                                <td><a class="btn btn-sm btn-info" href="#"><i
                                                            class="bi bi-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Latest Production</h4>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('production.index') }}">More
                                    Info</a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-striped" id="table-production">
                                    <thead>
                                        <tr>
                                            <th data-type="date">Date</th>
                                            <th>Status</th>
                                            <th data-sortable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestProductions as $production)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($production->production_date)->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    <span
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
                                                    </span>
                                                </td>
                                                <td><a class="btn btn-sm btn-info" href="#"><i
                                                            class="bi bi-eye"></i></a></td>
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
    const salesChartData = @json($salesChartData);
    const salesDates = salesChartData.map(data => data.date);
    const salesValues = salesChartData.map(data => data.total_sales);

    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: salesDates,
            datasets: [{
                label: 'Total Sales (Rp)',
                data: salesValues,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const productionChartData = @json($productionChartData);
    const productionDates = productionChartData.map(data => data.date);
    const productionValues = productionChartData.map(data => data.total_productions);

    const productionCtx = document.getElementById('productionChart').getContext('2d');
    const productionChart = new Chart(productionCtx, {
        type: 'bar',
        data: {
            labels: productionDates,
            datasets: [{
                label: 'Total Productions',
                data: productionValues,
                backgroundColor: 'rgba(153, 102, 255)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-sales");
            initDataTable("table-production");
        });
    </script>
@endpush
