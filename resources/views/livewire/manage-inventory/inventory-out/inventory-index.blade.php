<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.out.create') }}">
                <i class="bi bi-plus"></i>
                Add Data Inventory Out
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="col-auto">{{ $title }} Datatable</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="table-inventory-out-report">
              <thead>
                <tr>
                  <th>Batch Code Production</th>
                  <th data-type="date">Inventory Date</th>
                  <th>Product Name</th>
                  <th>Variant</th>
                  <th>Unit Price</th>
                  <th>Shelf Name</th>
                  <th>Initial Stock</th>
                  <th>Stock Sold</th>
                  <th>Expiration Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>NSR-S-001-BC001-01122024</td>
                  <td>01-12-2024</td>
                  <td>Nastar</td>
                  <td>Tabung S</td>
                  <td>Rp. 0</td>
                  <td>RAK-GUDANG-A-001</td>
                  <td>0</td>
                  <td>0</td>
                  <td>01-12-2025</td>
                </tr>
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
      min-width: 1500px !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      initDataTable("table-inventory-out-report");
    });
  </script>
@endpush
