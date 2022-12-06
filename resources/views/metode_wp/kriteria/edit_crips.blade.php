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
                            @include('metode_wp.menu')
                        </div>


                        <div class="card-body">
                            <form action="/metode/wp/{{ $crips->id }}/edit_crips" method="post">
                                @csrf
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" name="kode_kriteria"
                                        value="{{ $kriteria->kode_kriteria }}" readonly required
                                        aria-describedby="floatingInputHelp" />
                                    <label for="floatingInput">Kode Kriteria</label>

                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" name="nama_kriteria"
                                        value="{{ $crips->nama_kriteria }}" readonly required
                                        aria-describedby="floatingInputHelp" />
                                    <input type="hidden" name="id" value="{{ $kriteria->id }}">
                                    <label for="floatingInput">Nama Kriteria</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" name="crips"
                                        placeholder="Contoh. <=1.000.000" value="{{ $crips->crips }}"
                                        aria-describedby="floatingInputHelp" required />
                                    <label for="floatingInput">Crips</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="number" class="form-control" value="{{ $crips->nilai }}"
                                        id="floatingInput" name="nilai" placeholder="Nilai Bobot"
                                        aria-describedby="floatingInputHelp" required />
                                    <label for="floatingInput">Nilai Bobot</label>
                                </div>
                                <br>
                                <button type="submit" class="btn rounded-pill btn-primary">Edit</button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
            <!--/ Transactions -->
        </div>
    </div>
@endsection
