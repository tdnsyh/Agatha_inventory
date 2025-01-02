<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">

      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="col-12">
              <form action="#">
                <input class="form-control form-control-lg square" id="scan_barcode" type="text" placeholder="Input the Barcode or Scan the Barcode Code" autofocus>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-3">
          <div class="card">
            <div class="card-content">
              <img class="card-img-top img-fluid" src="https://asset.kompas.com/crops/VnqoA6qVt8W13t9l8ffMTPchAmY=/10x7:1000x667/1200x800/data/photo/2020/10/12/5f840dcab3c2b.jpg" alt="Card image cap" style="height: 20rem">
            </div>
            <div class="card-footer">
              <p class="card-text">
                <strong>Date Production:</strong> 15 Desember 2024<br>
                <strong>Date Expired:</strong> 15 Desember 2025<br>
              </p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-9">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <h4 class="card-title">Data Product : Inventory</h4>
                <table class="table">
                  <tbody>
                    <tr>
                      <td class="w-25">Batch Code Product</td>
                      <td>NSR-S-001-BC001-01122024</td>
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
                      <td>Shelf Name</td>
                      <td>RakGudang-A01</td>
                    </tr>
                    <tr>
                      <td>Initial Stock [IN]</td>
                      <td>50 Qty</td>
                    </tr>
                    <tr>
                      <td>Final Stock [IN]</td>
                      <td>40 Qty</td>
                    </tr>
                    <tr>
                      <td>Initial Stock [OUT]</td>
                      <td>10 Qty</td>
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
