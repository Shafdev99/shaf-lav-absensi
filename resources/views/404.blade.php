@extends('layout.auth')
@section('title', '404 Not Found !')
@section('content')
<div class="error text-center mx-auto mt-4">
    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor"
        class="bi bi-exclamation-triangle-fill mb-3" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
    </svg>
    <h1 class="code-no">404</h1>
    <h3 class="sub-error">Page Not Found</h3>
    <p class="ket-error">Halaman yang ada cari sepertinya tidak ada!</p>
    <div>
        <a href="{{ url('/') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
            </svg>
            Kembali
        </a>
    </div>
</div>
@endsection