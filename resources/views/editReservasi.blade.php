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
                        <form action="{{ url('update-reservasi/'.$reservasi->reservasi_id) }}" method="POST">
                            @csrf
                            {{-- Buat cek id aktif bisa atau tidak --}}
                            {{-- <p>{{Auth::user()->id}}</p> --}}
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control col-sm-10" value="{{$reservasi->no_hp}}" required>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-2 col-form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control col-sm-10" value="{{$reservasi->tanggal}}" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Jam Mulai</label>
                                    <div class="input-group">
                                        <input value="{{$reservasi->jam_awal}}" type="text" name="jam_awal" id="jam_awal" class="form-control timepickerMulai" placeholder="Klik disini.." readonly required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa-regular fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Jam Selesai</label>
                                    <div class="input-group">
                                        <input value="{{$reservasi->jam_akhir}}" type="text" name="jam_akhir" id="jam_akhir" class="form-control timepickerAkhir" placeholder="Klik disini.." readonly required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa-regular fa-clock"></i></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Durasi</label>
                                    <div class="input-group">
                                        <input value="{{$reservasi->durasi}}" type="number" name="durasi" id="durasi" min="1" max="100" class="form-control" readonly required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">Jam</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input value="{{$reservasi->harga}}" type="number" name="harga" id="harga" class="form-control" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <button type="button" id="hitung" class="btn btn-success px-3">Hitung Harga</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('input.timepickerMulai').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 60,
                minTime: '9',
                maxTime: '8:00pm',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('input.timepickerAkhir').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 60,
                minTime: '10',
                maxTime: '9:00pm',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>

    {{-- Script Menghitung Lama / Durasi --}}
    <script>
        document.getElementById("hitung").onclick = function() {hitung()};
        function hitung() {
            var valueAwal = document.getElementById("jam_awal").value;
            var valueAkhir = document.getElementById("jam_akhir").value;
            var splitAwal = valueAwal.split(":");
            var splitAkhir = valueAkhir.split(":");
            var durasi = parseInt(splitAkhir[0]) - parseInt(splitAwal[0]) ;
            var harga = durasi*50000;
            document.getElementById('durasi').value = durasi;
            document.getElementById('harga').value = harga;
        }
    </script>
@stop
