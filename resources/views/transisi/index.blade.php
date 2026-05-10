<!-- Content -->
@extends('layout.app')
@section('title', 'Transisi Semester')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Transisi Semester
            </div>
            {{-- End --}}


            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col-12 mb-3 mx-auto">
                    @if (session('sukses'))
                        <div class="alert alert-success" role="alert">
                            <h5 class="alert-heading fw-bold">{{ session('sukses') }}</h5>
                            <p class="mb-0">
                                Semua data berhasil dimasukan ke dalam
                                {{ session('semester_transisi') == 'ganjil' ? 'Tahun Ajaran Baru' : 'semester genap' }}!
                                <br>
                                Silakan login dengan menggunakan tahun ajar
                                <b>
                                    {{ session('tahun_ajar_transisi') . ' ' . session('semester_transisi') }}.
                                </b>
                            </p>
                        </div>
                    @endif
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Transisi Semester Desktop View --}}
                        <div class="d-flex justify-content-between">
                            <div class="bg-blobe p-3 fs-6 fw-bold rounded-3 align-self-center">
                                {{ session('tahun_ajar') . ' ' . session('semester') }}
                            </div>
                            <div class="">
                                <i class="bi bi-arrow-right" style="font-size: 3em;"></i>
                            </div>
                            <div class="bg-blobe p-3 fs-6 fw-bold rounded-3 align-self-center">
                                {{ $periode?->semester ? $periode?->tahun_ajar . ' ' . $periode?->semester : 'Data periode selanjutnya belum ada!' }}
                            </div>
                        </div>
                        {{-- End --}}
                    </div>

                    @if ($indikasi == 0)
                        <div class=" card p-lg-3 p-2 card-content mt-2">
                            {{-- Tombol Transisi Semester Desktop View --}}
                            <div class="d-flex justify-content-between">
                                <h6 class="align-self-center">
                                    Klik tombol disamping untuk memulai proses
                                </h6>
                                <a href="javascript:void(0);" onclick="prosesTransisi()" class="btn btn-primary">
                                    <i class="me-1 bi bi-arrow-repeat"></i>
                                    Proses Transisi
                                </a>
                            </div>
                            {{-- End --}}
                        </div>
                    @else
                        <d iv class=" card p-lg-3 p-2 pb-0 card-content mt-2">
                            {{-- Informasi Transisi Semester Desktop View --}}
                            <h6 class="text-center">
                                Proses Transisi Semester sudah dilakukan!
                            </h6>
                            {{-- End --}}
                        </d>
                    @endif

                </div>
            </div>
        </div>

    </div>

    {{-- Modal Transisi Semester --}}
    <div class="modal fade" id="transisiSemester" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="transisiSemesterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="transisiSemesterLabel">Transisi Semester</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="transisi-semester" class="text-center">
                        Pastikan semua data sudah tidak ada perubahan!
                    </p>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('proses.transisi.semester', $periode->id) }}" class="btn btn-primary">
                        <i class="me-1 bi bi-arrow-repeat"></i>
                        Proses
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

@endsection
@push('scripts')
    <script type="text/javascript">
        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif

        @if (session('gagal'))
            let pesan = "{{ session('gagal') }}"
            toastr.warning(pesan)
        @endif

        // Notif untuk data yang tidak lolos validasi
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning('{{ ucwords($error) }}');
            @endforeach
        @endif
        // End

        function prosesTransisi() {
            $('#transisiSemester').modal('show');
        }
    </script>
@endpush
