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
                                    <h4>Tahap Normalisasi Nilai W</h4>
                                    <hr size="6">
                                    <br>
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Nama Alternatif</th>
                                            <th colspan="{{ $jumlah }}" class="text-center">Normalisasi Nilai W</th>


                                        </tr>
                                        <tr>
                                            @foreach ($kriteria as $i)
                                                <th class="text-center">
                                                    {{ $i->kode_kriteria . ' ( ' . $i->atribut_kriteria . ' )' }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($nilaiW))
                                            @foreach ($nilaiW as $item => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item }}</td>

                                                    @foreach ($value as $key => $data)
                                                        <td class="text-center">{{ $data }}</td>
                                                    @endforeach


                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>

                            <div class="card-body">
                                <hr size="6">
                                <h4>Tahap Normalisasi Nilai S</h4>
                                <hr size="6">
                                <table id="table_id" class="display table table-striped table-hover table-bordered">

                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">No</th>
                                            <th class="text-center" style="padding-bottom:32px" rowspan="2">Nama
                                                Alternatif
                                            </th>
                                            <th colspan="{{ $jumlah }}" class="text-center">Normalisasi Nilai S</th>

                                            <th rowspan="2" class="text-center" style="padding-bottom:32px">Total</th>



                                        <tr>

                                            @foreach ($kriteria as $i)
                                                <th class="text-center">{{ $i->kode_kriteria }}</th>
                                            @endforeach

                                        </tr>

                                    </thead>
                                    @if (isset($nilaiS) || isset($kriteria))
                                        <tbody class="table-group-divider">
                                            @foreach ($nilaiS as $item => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item }}</td>
                                                    @foreach ($value as $key => $data)
                                                        <td class="text-center">{{ number_format($data, 4) }}</td>
                                                    @endforeach

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <div class="card-body">
                                <hr size="6">
                                <h4>Tahap Normalisasi Nilai V</h4>
                                <hr size="6">
                                <table id="table_id" class="display table table-striped table-hover table-bordered">

                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding-bottom:10px">No</th>
                                            <th class="text-center" style="padding-bottom:10px">Nama
                                                Alternatif
                                            </th>
                                            <th class="text-center"style="padding-bottom:10px">Normalisasi Nilai V</th>

                                            <th class="text-center" style="padding-bottom:10px">Rangking</th>





                                    </thead>
                                    @if (isset($hasilV) || isset($kriteria))
                                        <tbody class="table-group-divider">
                                            @foreach ($hasilV as $item => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item }}</td>
                                                    @foreach ($value as $key => $data)
                                                        <td class="text-center">{{ $data }}</td>
                                                    @endforeach

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
    @endsection
