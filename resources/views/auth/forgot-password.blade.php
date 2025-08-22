
@extends('layouts.app')

@section('title', 'Forgot Password - Home Security Portal')

@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Forgot Password -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-4">
                    <a href="{{ route('welcome') }}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <i class="fas fa-shield-alt fa-2x text-primary"></i>
                        </span>
                        <span class="app-brand-text demo text-body fw-bolder">SecureHome</span>
                    </a>
                </div>
                <!-- /Logo -->
                
                <h4 class="mb-2">Forgot Password? 🔒</h4>
                <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            autofocus
                            required
                        />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                </form>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
        <!-- /Forgot Password -->
    </div>
</div>
@endsection

@push('styles')
<style>
.authentication-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}

.authentication-inner {
    width: 100%;
    max-width: 400px;
}

.card {
    box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 10px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6b4190 100%);
    box-shadow: 0 4px 15px 0 rgba(102, 126, 234, 0.3);
}
</style>
@endpush
