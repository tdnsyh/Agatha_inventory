<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">

        <div class="col-12 col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="avatar avatar-2xl">
                  <img src="{{ asset('storage/assets/compiled/jpg/2.jpg') }}" alt="Avatar">
                </div>

                <h3 class="mt-3">User Production 01</h3>
                <p class="text-small"><span class="badge bg-primary">Production</span></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-8">
          <div class="card">
            <div class="card-body">
              <form action="#">
                <div class="form-group">
                  <label class="form-label">Full Name</label>
                  <input class="form-control" type="text" placeholder="Your Full Name">
                </div>
                <div class="form-group">
                  <label class="form-label">Username</label>
                  <input class="form-control" type="text" placeholder="Your Username">
                </div>
                <div class="form-group">
                  <label class="form-label" for="phone">Role</label>
                  <select class="choices form-select">
                    <option value="" selected>Select Your Role</option>
                    <option value="administrator">Administrator</option>
                    <option value="sales">Sales</option>
                    <option value="production">Production</option>
                    <option value="inventory">Inventory</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label" for="password">New Password</label>
                  <input class="form-control" type="password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label class="form-label" for="confirm_password">Confirm Password</label>
                  <input class="form-control"type="password" placeholder="Enter Confirm Password">
                </div>

                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>

@push('styles-priority')
  <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>
@endpush
