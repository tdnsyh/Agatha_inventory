<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">

              <div class="row g-3">
                <div class="col-12 col-md-auto">
                  <input class="form-control form-control-lg flatpickr" type="date" placeholder="Select Start Date">
                </div>

                <div class="col-12 col-md-auto">
                  <input class="form-control form-control-lg flatpickr" type="date" placeholder="Select End date">
                </div>

                <a class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary" href="#"><i class="bi bi-journal-bookmark"></i> Generate Sales Report</a>

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
              <div class="table-responsive">
                <table class="table table-striped" id="table-priority-analysis">
                  <thead>
                    <tr>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Variant</th>
                      <th>Transaction Date</th>
                      <th>Price Product</th>
                      <th>Quantity</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>NSR-S-001</td>
                      <td>Nastar</td>
                      <td>Tabung S</td>
                      <td>01-12-2024</td>
                      <td>Rp. 0</td>
                      <td>50</td>
                      <td>Rp. 0</td>
                    </tr>
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

@push('styles-priority')
  <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

  <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('styles')
  <style>
    .dataTable-table {
      min-width: 1000px !important;
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
      initDataTable("table-priority-analysis");
    });
  </script>
@endpush
