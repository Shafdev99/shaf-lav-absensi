@extends('layout.auth')
@section('title', 'Reset Password')
@section('content')
<div class="error mx-auto mt-2 card card-login">
    <h4 class="login-title text-center mb-4">Reset Password.</h4>
    <form action="{{ route('prosesReset') }}" method="POST" class="form-login d-flex flex-column ">
        @csrf
        @if (session('info'))
        <div class="alert alert-danger">
            {{ session('info') }}
        </div>
        @endif
        <div class="mb-3">
            <label for="username" class="form-label">Validasi</label>
            <input type="text" class="form-control form-borderless mb-4" placeholder="Masukan username atau email!"
                name="valid" required="required" />
            <div class="mt-4 form-check" style="padding-left: 0; font-size: 12px; font-weight: 500;">
                Kembali
                <a href="{{ url('/') }}" style="text-decoration: none;">login</a> ?
            </div>
        </div>

        <button type="submit" class="btn btn-primary mb-3 login-btn">
            Request
            <i class="bi bi-unlock-fill"></i>
        </button>
    </form>
</div>
@endsection