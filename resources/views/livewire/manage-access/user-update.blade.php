<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('manage-access.user.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ asset('assets/compiled/jpg/2.jpg') }}" alt="Avatar">
                                </div>
                                <h3 class="mt-3">{{ $user->full_name }}</h3>
                                <p class="text-small"><span class="badge bg-primary">Production</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="update">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" wire:model="full_name" class="form-control" id="full_name"
                                        required>
                                    @error('full_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" wire:model="username" class="form-control" id="username"
                                        required>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" wire:model="email" class="form-control" id="email"
                                        required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" wire:model="password" class="form-control" id="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" wire:model="password_confirmation" class="form-control"
                                        id="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update User</button>
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
