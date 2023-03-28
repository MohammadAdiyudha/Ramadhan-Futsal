@extends('adminlte::page')

@section('title', 'Buat Reservasi')

@section('content_header')
    <h1>Buat Reservasi</h1>
@stop

@section('content')
    <blockquote class="quote-olivia">
        <h5 class="text-olivia">Tips!</h5>
        <p>Pastikan jadwal tidak bentrok dengan jadwal lain. <br> Durasi dan Harga akan otomatis terhitung</p>
    </blockquote>
    <div class="container">
        <div class="row justify">
            <div class="col">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/buat-reservasi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- DEBUG - Buat cek id aktif bisa atau tidak --}}
                            {{-- <p>{{Auth::user()->id}}</p> --}}
                            <div class="form-row">
                                {{-- Kolom No HP / WA --}}
                                <div class="form-group col-md-6 mb-4">
                                    <label for="no_hp">No HP / WA</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                                    @error('no_hp')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kolom Tanggal --}}
                                <div class="form-group col-md-6 mb-4">
                                    <label for="tanggal">Tanggal</label>
                                    <div class="input-group">
                                        <input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Klik disini..." required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa-regular fa-calendar-days"></i></div>
                                        </div>
                                    </div>
                                    @error('tanggal')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row">
                                {{-- Kolom Jam Mulai --}}
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Jam Mulai</label>
                                    <div class="input-group">
                                        <input type="text" name="jam_awal" id="jam_awal" class="form-control timepickerMulai" placeholder="Klik disini.." readonly required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa-regular fa-clock"></i></div>
                                        </div>
                                    </div>
                                    @error('jam_awal')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kolom Jam Selesai --}}
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Jam Selesai</label>
                                    <div class="input-group">
                                        <input type="text" name="jam_akhir" id="jam_akhir" class="form-control timepickerAkhir" placeholder="Klik disini.." readonly required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa-regular fa-clock"></i></div>
                                        </div>
                                    </div>
                                    @error('jam_akhir')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- Kolom Durasi --}}
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Durasi</label>
                                    <div class="input-group">
                                        <input type="number" name="durasi" id="durasi" min="1" max="100" class="form-control" readonly required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">Jam</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Harga --}}
                                <div class="form-group col-md-6 mb-4">
                                    <label for="">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" name="harga" id="harga" class="form-control" readonly required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                {{-- Kolom Atas Nama Rekening --}}
                                <div class="form-group col-md-4 mb-4">
                                    <label for="atas_nama" class="col-form-label">Atas Nama Rekening</label>
                                    <input type="text" id="atas_nama" name="atas_nama" class="form-control" required>
                                </div>
                                {{-- Kolom Jeris Pembayaran --}}
                                <div class="form-group col-md-4 mb-4">
                                    <label for="jenis_bayar" class="col-form-label">Jenis Pembayaran</label>
                                    <select name="jenis_bayar" id="jenis_bayar" class="form-control">
                                        <option value="Cash">Cash / Langsung</option>
                                        <option value="Mandiri">Mandiri - 113-556-33743</option>
                                        <option value="Shopeepay">Shopeepay - 0811223344</option>
                                        <option value="Gopay">Gopay - 0811223344</option>
                                    </select>
                                </div>
                                {{-- Kolom Bukti Pembayaran --}}
                                <div class="form-group col-md-4 mb-4">
                                    <label for="" class="col-form-label">Bukti Pembayaran</label>
                                    <div class="custom-file">
                                        <input type="file" id="bukti_bayar" name="bukti_bayar" class="w-auto custom-file-input" required>
                                        <label class="custom-file-label" for="bukti_bayar">Pilih file gambar atau pdf...</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Button Submit --}}
                            <div class="form-group mb-4">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            // Time Picker Jam Awal / Mulai
            $('input.timepickerMulai').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 60,
                minTime: '9',
                maxTime: '10:00pm',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });

            // Fungsi untuk min time set time Jam Akhir lebih dari Jam Awal
            $('input.timepickerMulai').timepicker('option','change', function(time){
                var newMinAkhir = new Date(time.getTime() + (1 * 60 * 60 * 1000));
                $('input.timepickerAkhir').timepicker('option', 'minTime', newMinAkhir);
                $('input.timepickerAkhir').timepicker('setTime', newMinAkhir);
            });

            // Time Picker Jam Akhir / Selesai
            $('input.timepickerAkhir').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 60,
                minTime: '10',
                maxTime: '11:00pm',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });

            // Date Picker
            flatpickr("#tanggal", {
                enableTime: false,
                minDate: "today",
                "locale": "id",
            });

            // Auto Hitung Durasi dan Bayar
            $('input.timepickerAkhir').timepicker('option','change', function(time){
                var valueAwal = document.getElementById("jam_awal").value;
                var valueAkhir = document.getElementById("jam_akhir").value;
                var splitAwal = valueAwal.split(":");
                var splitAkhir = valueAkhir.split(":");
                var durasi = parseInt(splitAkhir[0]) - parseInt(splitAwal[0]) ;
                var harga = durasi*110000;
                document.getElementById('durasi').value = durasi;
                document.getElementById('harga').value = harga;
            });

            // Masking nomor telepon
            $('#no_hp').inputmask({
                mask: "9999  9999  99[9999]", //Hanya bisa diisi 10-13 Digit
                removeMaskOnSubmit: true,
                placeholder: ' ',
                showMaskOnHover: false,
                showMaskOnFocus: false,
            });
        });
    </script>
    {{-- Mengubah label menjadi nama file secara otomatis --}}
    <script>
        $('#bukti_bayar').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(cleanFileName);
            })
    </script>
@stop
