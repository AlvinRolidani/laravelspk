@extends('layouts.main')
@section('content')
    <style>
        .table-responsive {
            display: table
        }
    </style>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col-lg-12 col-md-4 order-0">
                    <div class="card">

                        <div class="card-header">
                            @include('metode_topsis.menu')
                        </div>
                        <div class="table-responsive">
                            <div class="card-body">

                                <div class="col-lg-4 col-md-4 mb-3 order-0">
                                    {{-- <h3>Crips Kriteria {{ ucwords($kriteria->nama_kriteria) }}</h3>
                                <a href="/metode/saw/crips/{{ $kriteria->kode_kriteria }}/tambah"
                                    class="btn rounded-pill btn-primary">Tambah Kriteria Crips</a> --}}
                                </div>

                                <table id="table_id" class="display table table-striped table-hover table-bordered">
                                    <hr size="6">
                                    <h4>Menghitung Matriks Keputusan Ternormalisasi</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            @foreach ($kriteria as $i)
                                                <td class="text-center">
                                                    {{ $i->kode_kriteria . ' ( ' . ucwords($i->atribut_kriteria) . ' )' }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>Pembagi</th>
                                            @foreach ($hasilAkar as $key => $value)
                                                @foreach ($value as $item => $value_1)
                                                    <td class="text-center">{{ $value_1 }}</td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    </thead>
                                </table>
                                <table id="table_id" class="display table table-striped table-hover table-bordered">
                                    <br>
                                    <br>
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">No</th>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">Nama
                                                Alternatif
                                            </th>
                                            <th colspan="{{ $jumlah }}" class="text-center">Normalisasi Terbagi</th>
                                        <tr>

                                            @foreach ($kriteria as $i)
                                                <th class="text-center">{{ $i->kode_kriteria }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody class="table-group-divider">
                                        @foreach ($normalisasiterbagi as $item => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach ($value as $key => $data)
                                                    <td class="text-center">{{ number_format($data, 5) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table id="table_id" class="display table table-striped table-hover table-bordered">
                                    <br>
                                    <hr size="6">
                                    <h4>Menghitung Matriks Keputusan Ternormalisasi dan Terbobot</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">No</th>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">Nama
                                                Alternatif
                                            </th>
                                            <th colspan="{{ $jumlah }}" class="text-center">Kriteria Ternormalisasi
                                                dan Terbobot</th>
                                        <tr>

                                            @foreach ($kriteria as $i)
                                                <th class="text-center">{{ $i->kode_kriteria }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody class="table-group-divider">
                                        @foreach ($solusi_ideal as $item => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach ($value as $key => $data)
                                                    <td class="text-center">{{ number_format($data, 5) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table id="table_id" class="display table table-striped table-hover table-bordered">
                                    <br>
                                    <hr size="6">
                                    <h4>Mencari Solusi Ideal Positif dan Negatif</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            @foreach ($kriteria as $i)
                                                <td class="text-center">
                                                    {{ $i->kode_kriteria . ' ( ' . ucwords($i->atribut_kriteria) . ' )' }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>MAX (Y+)</th>
                                            @foreach ($Amax as $key => $value)
                                                <td class="text-center">{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>MIN (Y-)</th>
                                            @foreach ($Amin as $key => $value)
                                                <td class="text-center">{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                </table>
                                <table id="table_id" class="display table table-striped table-hover table-bordered">
                                    <br>
                                    <hr size="6">
                                    <h4>Mencari Nilai D+ dan D- Setiap Alternatif</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:15px">No</th>
                                            <th class="text-center" style="padding-bottom:15px">Nama
                                                Alternatif
                                            </th>
                                            <th class="text-center" style="padding-bottom:15px">D+</th>
                                            <th class="text-center" style="padding-bottom:15px">D-</th>
                                    </thead>
                                    <tbody>

                                        @foreach ($merge_array as $item => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach ($value as $p => $key)
                                                    <td>{{ $key }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table id="table_id" class="display table table-striped table-hover table-bordered">
                                    <br>
                                    <hr size="6">
                                    <h4>Preferensi dan Rangking</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:15px">No</th>
                                            <th class="text-center" style="padding-bottom:15px">Nama
                                                Alternatif
                                            </th>
                                            <th class="text-center" style="padding-bottom:15px">Preferensi</th>
                                            <th class="text-center" style="padding-bottom:15px">Rank</th>
                                    </thead>
                                    <tbody>

                                        @foreach ($rank as $item => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach ($value as $p => $key)
                                                    <td>{{ $key }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>


                        </div>

                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
    @endsection
