@extends('adminlte::page')

@section('title', 'Buat Reservasi')

@section('content_header')
    <h1>Buat Reservasi</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Add Student</h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('buat-reservasi') }}" method="POST">
                        @csrf
                        <p>{{Auth::user()->id}}</p>
                        <div class="form-group mb-3">
                            <label for="">No HP</label>
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Course</label>
                            <input type="time" name="jam_awal" min="09:00" max="18:00" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Student Section</label>
                            <input type="time" name="jam_akhir" min="10:00" max="20:00" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Lama</label>
                            <input type="number" name="lama" min="1" max="100">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Harga</label>
                            <input type="number" name="harga">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Student</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
@stop
