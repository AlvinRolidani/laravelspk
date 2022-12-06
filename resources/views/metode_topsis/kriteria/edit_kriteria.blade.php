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

                            <form action="/metode/topsis/{{ $kriteria->id }}/edit_kriteria" method="post">
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
                                        placeholder="Nama Kriteria" aria-describedby="floatingInputHelp" required
                                        value="{{ $kriteria->nama_kriteria }}" />
                                    <label for="floatingInput">Nama Kriteria</label>
                                </div>
                                <br>


                                <select id="largeSelect" class="form-select form-select-lg" name="atribut_kriteria">
                                    <option disabled selected>Pilih Kriteria</option>
                                    <option value="cost" {{ $kriteria->atribut_kriteria == 'cost' ? 'selected' : '' }}>
                                        Cost</option>
                                    <option value="benefit"
                                        {{ $kriteria->atribut_kriteria == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                </select>
                                <br>
                                <div class="form-floating">
                                    <input type="number" class="form-control" value="{{ $kriteria->bobot }}"
                                        id="floatingInput" name="bobot" placeholder="Nilai Bobot"
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
