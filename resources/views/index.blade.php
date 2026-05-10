@extends('layout.auth')
@section('title', 'Login')
@section('content')
    <div class="error mx-auto mt-2 card card-login">
        <h1 class="login-title text-center mb-4">Masuk.</h1>
        <form action="{{ url('/auth') }}" method="POST" class="form-login d-flex flex-column">
            @csrf
            @if (session('gagal'))
                <div class="alert alert-danger">
                    {{ session('gagal') }}
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-success">
                    {!! session('info') !!}
                </div>
            @endif
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control form-borderless " placeholder="Masukan username!" id="username"
                    name="username" required="required" />

                <label for="password" class="form-label mt-4 ">Password</label>
                <div class="d-flex position-relative group-show-password">
                    <input type="password" id="password" class="form-control form-borderless input-show-password"
                        placeholder="Masukan password!" name="password" required="required" />
                    <button class="btn btn-show-password" type="button" onclick="showPassword(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg>
                    </button>
                </div>
                <label for="semester" class="form-label mt-4">Semester</label>
                <select name="tahun_ajar_id" class="form-select form-borderless">
                    @foreach ($tahunAjar as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->tahun_ajar . ' ' . Str::ucfirst($item->semester) }}
                        </option>
                    @endforeach
                </select>


                <div class="mt-4 form-check remember-btn d-flex justify-content-between">
                    <input type="checkbox" class="form-check-input" name="remember" value="true" id="exampleCheck1" />
                    <label class="form-check-label me-auto ms-2" for="exampleCheck1">Ingat saya!</label>
                    <a href="{{ route('resetPassword') }}">Lupa kata sandi?</a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-3 login-btn">Login</button>
        </form>
    </div>

@endsection
