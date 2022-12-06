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

                        <div class="card-body">

                            <div class="col-lg-4 col-md-4 mb-3 order-0">
                                {{-- <h3>Crips Kriteria {{ ucwords($kriteria->nama_kriteria) }}</h3>
                                <a href="/metode/saw/crips/{{ $kriteria->kode_kriteria }}/tambah"
                                    class="btn rounded-pill btn-primary">Tambah Kriteria Crips</a> --}}
                            </div>

                            <table id="table_id" class="display table table-striped table-hover table-bordered">

                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="padding-bottom:32px">No</th>
                                        <th rowspan="2" class="text-center" style="padding-bottom:32px">Nama Alternatif
                                        </th>
                                        <th colspan="{{ $jumlah }}" class="text-center">
                                            Kriteria</th>
                                        <th rowspan="2" class="text-center" style="padding-bottom:32px">Actions</th>

                                    </tr>
                                    <tr>
                                        @foreach ($kriteria as $i)
                                            <th class="text-center">{{ $i->kode_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($alternatif as $item => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->nama_alternatif }}</td>
                                            @if (count($value->penilaian) > 0)
                                                @foreach ($value->penilaian as $key => $data)
                                                    <td class="text-center">{{ $data->crips->nilai }}</td>
                                                @endforeach
                                            @endif
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="/metode/topsis/{{ $value->id }}/edit_nilai"><i
                                                                class="bx bx-edit-alt me-1"></i> Edit Nilai</a>
                                                    </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td>Tidak ada data</td>
                                        </tr>
                                    @endforelse
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
