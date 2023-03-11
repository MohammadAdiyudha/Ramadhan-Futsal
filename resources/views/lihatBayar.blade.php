@extends('adminlte::page')

@section('title', 'Buat Reservasi')

@section('content_header')
    <h1>Buat Reservasi</h1>
@stop

@section('content')
    <blockquote class="quote-olivia">
        <h5 class="text-olivia">Tips!</h5>
        <p>Pastikan jadwal tidak bentrok dengan jadwal lain.</p>
        <p>
            Tekan tombol <strong>Hitung Harga</strong> sebelum menekan tombol <strong>Submit</strong>
            untuk melihat total yang perlu dibayar.
        </p>
    </blockquote>
    <div class="container">
        <div class="row justify">
            <div class="col-md-8">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="card">
                    <div class="card-body">
                        {{-- BUAT DEBUG --}}
                        {{-- {{$reservasi->reservasi_id}} --}}

                            {{-- Buat cek id aktif bisa atau tidak --}}
                            {{-- <p>{{Auth::user()->id}}</p> --}}
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">Bayar ID</label>
                                <input type="text" name="bayar_id" class="form-control col-sm-10" value="{{$pembayaran->bayar_id}}" readonly>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">Reservasi ID</label>
                                <input type="text" name="reservasi_id" class="form-control col-sm-10" value="{{$pembayaran->reservasi_id}}" readonly>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">Atas Nama</label>
                                <input type="text" name="atas_nama" class="form-control col-sm-10" value="{{$pembayaran->atas_nama}}" readonly>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">Jenis Bayar</label>
                                <input type="text" name="jenis_bayar" class="form-control col-sm-10" value="{{$pembayaran->jenis_bayar}}" readonly>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">Bukti Bayar</label>
                                <input type="text" name="bukti_bayar" class="form-control col-sm-10" value="{{$pembayaran->bukti_bayar}}" readonly>
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
@stop
