<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('manage-access.user.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>

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
              <label class="form-label" for="password">Password</label>
              <input class="form-control" type="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
              <label class="form-label" for="confirm_password">Confirm Password</label>
              <input class="form-control"type="password" placeholder="Enter Confirm Password">
            </div>

            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save User</button>
            </div>
          </form>
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
