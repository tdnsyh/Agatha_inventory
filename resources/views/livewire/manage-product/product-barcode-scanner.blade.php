<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="#" wire:submit.prevent="searchProduct">
                        <div class="input-group">
                            <input class="form-control form-control-lg square" id="scan_barcode" type="text"
                                wire:model="barcode" placeholder="Input the Batch Code" autofocus>
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <img class="card-img-top object-fit-cover"
                                src="{{ $product ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                                alt="Card image cap" style="height: 20rem">
                        </div>
                        <div class="card-footer">
                            <p class="card-text">
                                <strong>Date Expired:</strong> {{ $product ? $product->expired_day : 'N/A' }} Day<br>
                                <strong>Date Production:</strong>
                                {{ $product ? $product->created_at->format('d M Y') : 'N/A' }}<br>
                                <strong>Expiration Date:</strong>
                                {{ $inventoryIn ? $inventoryIn->expiration_date->format('d M Y') : 'N/A' }}<br>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Data Product : Inventory</h4>
                                @if ($inventoryIn)
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="w-25">Batch Code</td>
                                                <td>{{ $inventoryIn->batch_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>Name Product</td>
                                                <td>{{ $product->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Variant Product</td>
                                                <td>{{ $product->variant }}</td>
                                            </tr>
                                            <tr>
                                                <td>Price Product</td>
                                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Shelf Name</td>
                                                <td>{{ $inventoryIn->shelf_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Initial Stock [IN]</td>
                                                <td>{{ $inventoryIn->initial_stock }} Qty</td>
                                            </tr>
                                            <tr>
                                                <td>Final Stock [IN]</td>
                                                <td>{{ $inventoryIn->final_stock }} Qty</td>
                                            </tr>
                                            <tr>
                                                <td>Initial Stock [OUT]</td>
                                                <td>{{ $inventoryOut ? $inventoryOut->initial_stock : 'N/A' }} Qty</td>
                                            </tr>
                                            <tr>
                                                <td>Stock Sold [OUT]</td>
                                                <td>{{ $inventoryOut ? $inventoryOut->stock_sold : 'N/A' }} Qty</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>No product found for this batch code.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
