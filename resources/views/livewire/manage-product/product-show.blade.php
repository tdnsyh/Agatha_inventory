<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('product.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="card-img-top" />
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                <div class="card-footer"></div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h2>{{ $product->name }}</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Code</th>
                                        <td>{{ $product->code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Variant</th>
                                        <td>{{ $product->variant }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Expired Day</th>
                                        <td>{{ $product->expired_day }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock</th>
                                        <td>{{ $product->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $product->updated_at->format('Y-m-d ') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
