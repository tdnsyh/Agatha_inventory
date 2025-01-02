<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('sales.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Transaction Date</label>
                <input class="form-control form-control-lg" type="text" value="01-12-2024" readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Total Amount</label>
                <input class="form-control form-control-lg" type="text" placeholder="Total Amount" readonly>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-detail-sales">
                      <thead>
                        <tr>
                          <th>Batch Code Production</th>
                          <th>Code Product</th>
                          <th>Name Product</th>
                          <th>Variant Product</th>
                          <th>Price Product</th>
                          <th data-type="date">Expiration Date</th>
                          <th>Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>NSR-S-001-BC001-01122024</td>
                          <td>NSR-S-001</td>
                          <td>Nastar</td>
                          <td>Tabung S</td>
                          <td>Rp. 0</td>
                          <td>01-12-2024</td>
                          <td>0</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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
      initDataTable("table-detail-sales");
    });
  </script>
@endpush
