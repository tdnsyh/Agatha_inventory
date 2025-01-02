<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            @if ($error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endif
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Log in with your data user.</p>
            <form wire:submit.prevent="login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" wire:model="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" wire:model="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="mt-4">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
