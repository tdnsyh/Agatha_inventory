<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.request') }}">
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
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label class="form-label">Request Production From</label>
                                            <input class="form-control form-control-lg" type="text"
                                                value="user_inventory_001" placeholder="Request Form" readonly>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="form-label">Reference Request Production ID </label>
                                            <input class="form-control form-control-lg" type="number" value="1"
                                                placeholder="Refrence Request Production ID" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Production Date</label>
                                    <input class="form-control form-control-lg flatpickr" type="date"
                                        placeholder="Select Production Date">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Production Status</label>
                                    <select class="choices form-select">
                                        <option value="">Select Your Status</option>
                                        <option value="In Progress" selected>In Progress</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Note</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Your Note">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Shelf Name</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Your Shelf Name">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Save Production</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-detail-production">
                                            <thead>
                                                <tr>
                                                    <th>Code Product</th>
                                                    <th>Name Product</th>
                                                    <th>Variant Product</th>
                                                    <th>Price Product</th>
                                                    <th data-type="date">Expiration Date</th>
                                                    <th>Stock Produced</th>
                                                    <th>Shelf Name</th>
                                                    <th data-sortable="false">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>NSR-S-001</td>
                                                    <td>Nastar</td>
                                                    <td>Tabung S</td>
                                                    <td>Rp. 0</td>
                                                    <td>01-12-2024</td>
                                                    <td>0</td>
                                                    <td>RAKGUDANG-A001</td>
                                                    <td>
                                                        <a class="btn icon icon-left btn-sm btn-danger"
                                                            href="#"><i class="bi bi-trash"></i></a>
                                                    </td>
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
