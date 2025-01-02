<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.out.index') }}">
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
              <form action="#">
                <div class="form-group">
                  <label class="form-label">Inventory Date</label>
                  <input class="form-control flatpickr" type="date">
                </div>
                <div class="form-group">
                  <label class="form-label">Shelf Name</label>
                  <input class="form-control" type="text" placeholder="Your Shelf Name">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Save Inventory Out</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Batch Code Product</label>
                <input class="form-control form-control-lg square" type="text" placeholder="Input the Barcode or Scan the Barcode Code" autofocus>
              </div>
              <div class="form-group">
                <label class="form-label">Quantity</label>
                <input class="form-control form-control-lg square" type="text" placeholder="Your Product Quantity">
              </div>

              <div class="row">
                <div class="col-12 col-md-3 pb-4">
                  <img class="card-img-top img-fluid" src="https://asset.kompas.com/crops/VnqoA6qVt8W13t9l8ffMTPchAmY=/10x7:1000x667/1200x800/data/photo/2020/10/12/5f840dcab3c2b.jpg" alt="Card image cap" style="height: 20rem">
                </div>

                <div class="col-12 col-md-9">
                  <h3>Data Product</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="w-25">Code Product</td>
                        <td>NSR-S-001</td>
                      </tr>
                      <tr>
                        <td>Name Product</td>
                        <td>Nastar</td>
                      </tr>
                      <tr>
                        <td>Variant Product</td>
                        <td>Tabung S</td>
                      </tr>
                      <tr>
                        <td>Price Product</td>
                        <td>Rp. 0</td>
                      </tr>
                      <tr>
                        <td>Stock Product on Inventory</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Expiration Date</td>
                        <td>01-12-2024</td>
                      </tr>
                    </tbody>
                  </table>
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
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

  <script>
    flatpickr('.flatpickr', {
      dateFormat: "d-m-Y",
      defaultDate: new Date(),
    })
  </script>
@endpush
