@extends('adminlte::page')

@section('title', 'Lihat Bukti Bayar')

@section('content_header')
    <h1>Lihat Bukti Bayar</h1>
@stop

@section('content')
    <blockquote class="quote-olivia">
        <h5 class="text-olivia">Tips!</h5>
        <p>Pastikan pembayaran sudah diterima.</p>
    </blockquote>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{asset('assets/buktiBayar/'.$pembayaran->bukti_bayar)}}" alt="bukti bayar" class="img-fluid">
            </div>
            <div class="col">
                <div class="row justify">
                    <div class="col">
                        @if (session('status'))
                            <h6 class="alert alert-success">{{ session('status') }}</h6>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                {{-- BUAT DEBUG --}}
                                {{-- {{$reservasi->reservasi_id}} --}}

                                    {{-- Buat cek id aktif bisa atau tidak --}}
                                    {{-- <p>{{Auth::user()->id}}</p> --}}
                                    <div class="form-group col mb-4">
                                        <label for="" class="col-form-label">Bayar ID</label>
                                        <input type="text" name="bayar_id" class="form-control" value="{{$pembayaran->bayar_id}}" readonly>
                                    </div>
                                    <div class="form-group col mb-4">
                                        <label for="" class="col-form-label">Reservasi ID</label>
                                        <input type="text" name="reservasi_id" class="form-control" value="{{$pembayaran->reservasi_id}}" readonly>
                                    </div>
                                    <div class="form-group col mb-4">
                                        <label for="" class="col-form-label">Atas Nama</label>
                                        <input type="text" name="atas_nama" class="form-control" value="{{$pembayaran->atas_nama}}" readonly>
                                    </div>
                                    <div class="form-group col mb-4">
                                        <label for="" class="col-form-label">Jenis Bayar</label>
                                        <input type="text" name="jenis_bayar" class="form-control" value="{{$pembayaran->jenis_bayar}}" readonly>
                                    </div>
                                    <form action="{{ route('konfirmasiBayar', $pembayaran->reservasi_id) }}" method="post">
                                        @csrf
                                        <div class="btn-group">
                                            <button type="submit" name="btnaction" value="tidak valid" class="btn btn-danger">Tidak Valid</button>
                                            <button type="submit" name="btnaction" value="valid" class="btn btn-success">Valid</button>
                                        </div>
                                    </form>
                            </div>
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
