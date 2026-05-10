<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Semester')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Semester
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col mx-auto">
                    <div class=" card p-lg-3 p-2 card-content">

                        {{-- Header Button --}}
                        <form action="{{ route('semester.update') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="input-group">
                                <label for="" class="pe-2" style="width: 100px;">Pilih Jumlah Semester</label>
                                <select class="form-select" {{ $nilai?->semester()->exists() ? 'disabled' : '' }}
                                    name="semester" id="" width="50">
                                    <option value="6" {{ $semester->count() == 6 ? 'selected' : '' }}>
                                        6 Semeter
                                    </option>
                                    <option value="12" {{ $semester->count() == 12 ? 'selected' : '' }}>
                                        12 Semester
                                    </option>
                                </select>
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-send-fill me-1"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                        {{-- End --}}

                        {{-- Table semester Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th>
                                    No
                                </th>
                                <th>semester</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse ($semester as $row)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        <div class="badge-globe px-3 my-auto">
                                            <span class="fs-6">
                                                Semester
                                                {{ $row->semester }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="bi bi-arrow-right fw-bold fs-4"></i>
                                    </td>
                                    <td>
                                        <span class="fw-bold">
                                            {{ $row->semester % 2 == 0 ? 'Semester Genap / Semester 2' : 'Semester Ganjil / Semester 1' }}

                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" align="center">
                                        Belum ada data semester!
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                        {{-- End --}}

                        {{-- Table semester Mobile View --}}
                        @if ($semester)
                            @foreach ($semester as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $loop->iteration }}). &nbsp;{{ $item->semester }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data semester!</p>
                        @endif
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" onclick="addSemester()" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif

        // Notif untuk data yang tidak lolos validasi
        @error('semester')
            let pesan = "{{ ucwords($message) }}"
            toastr.warning(pesan);
        @enderror
        // End
    </script>
@endpush
