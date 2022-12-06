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

                            <table id="table_id" class="display table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Crips</th>
                                        <th>Actions</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai as $item => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ ucwords($value->crips->nama_kriteria) }}</td>
                                            <td>{{ ucwords($value->crips->crips) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop{{ $value->crips->id }}"><i
                                                                class="bx bx-plus me-1"></i>
                                                            Edit Nilai Crips</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="staticBackdrop{{ $value->crips->id }}"
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
                                                    <form action="/metode/saw/{{ $value->alternatif_id }}/edit_nilai"
                                                        method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" name="crips"
                                                                value="{{ $value->crips->id }}">
                                                            @php
                                                                $c = DB::table('crips_saw')
                                                                    ->where('kriteria_id', $value->crips->kriteria_id)
                                                                    ->get();
                                                            @endphp
                                                            <div class="mt-2 mb-3">
                                                                <label for="largeSelect"
                                                                    class="form-label">{{ $value->crips->nama_kriteria }}</label>
                                                                <select id="largeSelect" name="crips_id"
                                                                    class="form-select form-select-lg">
                                                                    <option disabled selected value="">--Pilih--
                                                                    </option>
                                                                    @foreach ($c as $t => $data)
                                                                        <option value="{{ $data->id }}"
                                                                            {{ $value->crips_id == $data->id ? 'selected' : '' }}>
                                                                            {{ $data->crips }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Edit</button>
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
