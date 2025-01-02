<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('product.create') }}">
                                <i class="bi bi-plus"></i>
                                Add Data Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="col-auto">{{ $title }} Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Variant</th>
                                        <th>Price</th>
                                        <th>Expired Day</th>
                                        <th>Stock</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->variant }}</td>
                                            <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                                            <td>{{ $product->expired_day }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->updated_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <a href="{{ route('product.show', $product->id) }}"
                                                    class="btn btn-info btn-sm">Details</a>
                                                <a href="{{ route('product.update', $product->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button wire:click="destroy({{ $product->id }})"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $products->links() }}
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
            initDataTable("table-product");
        });
    </script>
@endpush
