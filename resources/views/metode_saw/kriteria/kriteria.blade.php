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
                        <div class="card-body">

                            <div class="col-lg-4 col-md-4 mb-3 order-0">

                                <a href="/metode/saw/tambah_kriteria" class="btn rounded-pill btn-primary">Tambah Kriteria</a>
                            </div>
                            <table id="table_id" class="display table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kriteria</th>
                                        <th>Nama Kriteria</th>
                                        <th>Atribut Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($item->kode_kriteria) }}</td>
                                            <td>{{ ucwords($item->nama_kriteria) }}</td>
                                            <td>{{ ucwords($item->atribut_kriteria) }}</td>
                                            <td>{{ $item->bobot }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>

                                                    <div class="dropdown-menu">

                                                        <a class="dropdown-item"
                                                            href="/metode/saw/crips/{{ $item->id }}"><i
                                                                class="bx bx-edit-alt me-1"></i> Edit Crips</a>
                                                        <a class="dropdown-item"
                                                            href="/metode/saw/{{ $item->id }}/edit_kriteria"><i
                                                                class="bx bx-edit-alt me-1"></i> Edit Kriteria</a>
                                                    </div>
                                                </div>
                                            </td>



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
