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

                                <a href="/metode/topsis/tambah_alternatif" class="btn rounded-pill btn-primary">Tambah
                                    Alternatif </a>
                            </div>
                            <table id="table_id" class="display table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Alternatif</th>
                                        <th>Nama Alternatif</th>
                                        <th>Actions</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatif as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($item->kode_alternatif) }}</td>
                                            <td>{{ ucwords($item->nama_alternatif) }}</td>


                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop{{ $item->kode_alternatif }}"><i
                                                                class="bx bx-plus me-1"></i>
                                                            Tambah Nilai Alternatif</button>
                                                        <a class="dropdown-item"
                                                            href="/metode/topsis/{{ $item->id }}/edit_alternatif"><i
                                                                class="bx bx-edit-alt me-1"></i> Edit Alternatif</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="bx bx-trash me-1"></i> Hapus Nilai Alternatif</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <div class="modal fade" id="staticBackdrop{{ $item->kode_alternatif }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/metode/topsis/tambah_nilai" method="post">
                                                        <div class="modal-body">
                                                            @csrf

                                                            @foreach ($kriteria as $i => $key)
                                                                <input type="hidden" name="alternatif_id"
                                                                    value="{{ $item->id }}">
                                                                <div class="mt-2 mb-3">
                                                                    <label for="largeSelect"
                                                                        class="form-label">{{ $key->nama_kriteria }}</label>
                                                                    <select id="largeSelect" name="crips_id[]"
                                                                        class="form-select form-select-lg">
                                                                        <option disabled selected value="">--Pilih--
                                                                        </option>
                                                                        @foreach ($key->crips as $t => $data)
                                                                            <option value="{{ $data->id }}">
                                                                                {{ $data->crips }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
