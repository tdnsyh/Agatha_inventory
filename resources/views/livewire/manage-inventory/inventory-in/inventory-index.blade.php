<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="col-auto">{{ $title }} Datatable</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-inventory-in">
                            <thead>
                                <tr>
                                    <th>Batch Code</th>
                                    <th data-type="date">Date</th>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th>Shelf</th>
                                    <th>Initial Stock</th>
                                    <th>Final Stock</th>
                                    <th>Expiration Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventoryIn as $item)
                                    <tr>
                                        <td>{{ $item->batch_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->inventory_date)->format('d-m-Y') }}</td>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>{{ $item->product->variant ?? 'N/A' }}</td>
                                        <td>{{ $item->shelf_name }}</td>
                                        <td>{{ $item->initial_stock }}</td>
                                        <td>{{ $item->final_stock }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->expiration_date)->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#barcodeModal"
                                                data-code="{{ $item->batch_code }}">
                                                Barcode
                                            </a>
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
    <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalLabel">Barcode for Batch Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="barcodeImage" src="" alt="Barcode" class="img-fluid" />
                    <br><br>
                    <a id="downloadBarcode" href="#" class="btn btn-success">Download Barcode</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('a[data-bs-target="#barcodeModal"]').forEach(function(element) {
            element.addEventListener('click', function() {
                const batchCode = element.getAttribute('data-code');
                const barcodeImage = document.getElementById('barcodeImage');
                const downloadBarcode = document.getElementById('downloadBarcode');
                JsBarcode(barcodeImage, batchCode, {
                    format: "CODE128",
                    displayValue: true
                });

                downloadBarcode.setAttribute('href', barcodeImage.src);
                downloadBarcode.setAttribute('download', batchCode + ".png");
            });
        });
    });
</script>
@push('styles-priority')
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
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-inventory-in");
        });
    </script>
@endpush
