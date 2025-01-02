<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form action="#">
                <div class="row g-3">
                  <div class="col-12 col-md-auto">
                    <input class="form-control form-control-lg flatpickr" type="date" placeholder="Select Start Date">
                  </div>
                  <div class="col-12 col-md-auto">
                    <input class="form-control form-control-lg flatpickr" type="date" placeholder="Select End date">
                  </div>
                  <a class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary" href="#"><i class="bi bi-journal-bookmark"></i> Generate Sales Report</a>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">{{ $title }} Datatable</h5>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a data-bs-toggle="tab" class="nav-link active" href="#report-inventory-in" role="tab">Inventory [IN]</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a data-bs-toggle="tab" class="nav-link" href="#report-inventory-out" role="tab">Inventory [OUT]</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="report-inventory-in" role="tabpanel">
                  <div class="table-responsive mt-4">
                    <table class="table table-striped" id="table-inventory-in-report">
                      <thead>
                        <tr>
                          <th>Batch Code Production</th>
                          <th data-type="date">Inventory Date</th>
                          <th>Product Name</th>
                          <th>Variant</th>
                          <th>Unit Price</th>
                          <th>Shelf Name</th>
                          <th>Initial Stock</th>
                          <th>Final Stock</th>
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

                <div class="tab-pane fade" id="report-inventory-out" role="tabpanel">
                  <div class="table-responsive mt-4">
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
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
</div>

@push('styles-priority')
  <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

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
  <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

  <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

  <script>
    flatpickr('.flatpickr', {
      dateFormat: "d-m-Y",
      minDate: "01.01.2017",
      maxDate: "15.12.2018",
    })
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      initDataTable("table-inventory-in-report");
      initDataTable("table-inventory-out-report");
    });
  </script>
@endpush
