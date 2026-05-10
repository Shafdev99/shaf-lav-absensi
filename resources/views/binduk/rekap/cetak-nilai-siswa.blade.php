<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @media print {
            * {
                font-family: 'Courier New', Courier, monospace;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
            }

            .judul {
                font-size: 14px;
                text-align: center;
            }

            table.nilai {
                font-size: 12px !important;
                border-spacing: 0px !important;
                width: 100%;
            }

            table tr {
                width: 100%;
            }

            .img {
                text-align: center !important;
            }
        }
    </style>
</head>

<body>
    {{-- KOP DAN JUDUL BUKU INDUK SISWA --}}
    <div class="img">
        <img src="{{ asset('storage/' . $sekolah->kop_binduk) }}" width="700">
    </div>
    <h3 class="judul">NILAI AKADEMIK</h3>

    <br>

    <table class="nilai" border="1">
        <tr class="">
            {{-- <th rowspan="3" valign="middle" style="text-align: center;">No Urut</th> --}}
            <th rowspan="3" valign="middle" style="text-align: center;">Nama Mapel</th>

            {{-- Kolom Kelas --}}
            @foreach ($tingkat as $tkt)
                <th colspan="4" style="text-align: center">Kelas {{ $tkt->tingkat }}</th>
            @endforeach
            {{-- End --}}
        </tr>

        <tr>
            {{-- Kolom Semester --}}
            @foreach ($semester as $smt)
                <td align="center" colspan="2">
                    {{ $smt->semester % 2 == 0 ? 'Semester 2' : 'Semester 1' }}
                    {{-- {{ $smt->semester }} --}}
                </td>
            @endforeach
            {{-- End --}}
        </tr>

        <tr>
            {{-- Kolom KKM --}}
            @for ($i = 0; $i < $semester->count(); $i++)
                <td align="center">KKM</td>
                <td align="center">Nilai</td>
            @endfor
            {{-- End --}}
        </tr>

        {{-- Baris Kelompok Mapel --}}
        @foreach ($kelma as $row)
            <tr class="kema">
                <td style="padding: 8px 0px 8px 20px;" colspan="{{ $semester->count() * 2 + 1 }}">
                    <h4>
                        {{ $row->kelompok_mapel }}
                    </h4>
                </td>
            </tr>

            {{-- Baris Mapel --}}
            @foreach ($kurMapel as $item)
                @if ($row->id == $item->kelompok_mapel_id)
                    <tr>
                        <td style="padding: 6px 0px 6px 35px;">
                            {{ $item->urutan_mapel }}).
                            {{ $item->mapel }}
                        </td>

                        {{-- Kolom Kelola Nilai --}}
                        @foreach ($semester as $smt)
                            <td align="center">{{ $item->kkm }}</td>
                            <td align="center">
                                @php
                                    $nilai_rapor = null;
                                    $nilai_id = null;
                                @endphp

                                @foreach ($smt->nilai as $point)
                                    @if ($point->mapel_id === $item->mapel_id)
                                        @php
                                            $nilai_rapor += $point->nilai;
                                            $nilai_id = $point->id;
                                        @endphp
                                    @endif
                                @endforeach

                                {{-- Nilai Rapor --}}
                                {{ $nilai_rapor }}
                                {{-- End --}}
                            </td>
                        @endforeach
                        {{-- End --}}

                    </tr>
                @endif
            @endforeach
            {{-- End --}}
        @endforeach
        {{-- End --}}
    </table>

</body>

</html>
