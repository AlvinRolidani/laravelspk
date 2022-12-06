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
                            @include('metode_saw.menu_saw')
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
                                    <h4>Tahap Normalisasi</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Nama Alternatif</th>
                                            <th colspan="{{ $jumlah }}" class="text-center">Normalisasi</th>


                                        </tr>
                                        <tr>
                                            @foreach ($kriteria as $i)
                                                <th class="text-center">{{ $i->kode_kriteria }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($normalisasi as $item => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item }}</td>

                                                @foreach ($value as $key => $data)
                                                    <td class="text-center">{{ $data }}</td>
                                                @endforeach


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>

                            <div class="card-body">
                                <hr size="6">
                                <h4>Tahap Perangkingan</h4>
                                <hr size="6">
                                <table id="table_id" class="display table table-striped table-hover table-bordered">

                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">No</th>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">Nama
                                                Alternatif
                                            </th>
                                            <th rowspan="2" class="text-center" style="padding-bottom:32px">Total</th>
                                            <th colspan="{{ $jumlah }}" class="text-center">Normalisasi</th>
                                            <th rowspan="2" class="text-center" style="padding-bottom:32px">Ranking</th>



                                        <tr>

                                            @foreach ($kriteria as $i)
                                                <th class="text-center">{{ $i->kode_kriteria }}</th>
                                            @endforeach

                                        </tr>

                                    </thead>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <td></td>
                                            <th colspan="2">Bobot</th>
                                            @foreach ($kriteria as $i)
                                                <th class="text-center">{{ $i->bobot }}</th>
                                            @endforeach

                                        </tr>
                                        @foreach ($coll as $item => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach ($value as $key => $data)
                                                    <td class="text-center">{{ number_format($data, 2) }}</td>
                                                @endforeach

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
    @endsection
