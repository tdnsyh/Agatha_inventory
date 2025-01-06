<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <x-partials.alert />
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('manage-access.user.create') }}">
                        <i class="bi bi-plus"></i>
                        Add Data User
                    </a>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="col-auto">{{ $title }} Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('manage-access.user.update', $user->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button wire:click="delete({{ $user->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>

@push('styles-priority')
    <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('scripts')
    <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initDataTable("table-user");
        });
    </script>
@endpush
