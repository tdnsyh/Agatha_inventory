<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="saveProduction">
                            <div class="form-group">
                                <label>Production Date</label>
                                <input wire:model="production_date" class="form-control" type="date" required>
                            </div>
                            <div class="form-group">
                                <label>Production Request</label>
                                <select wire:model="selected_production_request_id" class="form-control">
                                    <option value="">Select a Production Request</option>
                                    @foreach ($production_requests as $request)
                                        <option value="{{ $request->id }}">
                                            {{ $request->product->name }} - {{ $request->quantity_request }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selected_production_request_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Production Status</label>
                                <select wire:model="production_status" class="form-control">
                                    <option value="In Progress">In Progress</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea wire:model="note" class="form-control" placeholder="Your Note"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save Production</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <select wire:model="selected_product" class="form-control">
                                    <option value="">Select Your Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} -
                                            {{ $product->variant }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input wire:model="quantity_produced" class="form-control" type="number"
                                    placeholder="Quantity">
                            </div>
                            <div class="col-lg-2">
                                <input wire:model="shelf_name" class="form-control" type="text"
                                    placeholder="Shelf Name">
                            </div>
                            <div class="col-lg-2">
                                <button wire:click.prevent="addDetailProduction" class="btn btn-primary">Add To
                                    List</button>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Variant</th>
                                        <th>Quantity</th>
                                        <th>Shelf Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_productions as $index => $detail)
                                        <tr>
                                            <td>{{ $detail['product_code'] }}</td>
                                            <td>{{ $detail['product_name'] }}</td>
                                            <td>{{ $detail['variant'] }}</td>
                                            <td>{{ $detail['quantity_produced'] }}</td>
                                            <td>{{ $detail['shelf_name'] }}</td>
                                            <td>
                                                <button
                                                    wire:click.prevent="removeDetailProduction({{ $index }})"
                                                    class="btn btn-danger btn-sm">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">

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
    <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>

    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        flatpickr('.flatpickr', {
            dateFormat: "d-m-Y",
            defaultDate: new Date(),
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-detail-production");
        });
    </script>
@endpush
