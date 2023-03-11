@extends('adminlte::page')

@section('title', 'Data Reservasi')

@section('content_header')
    <h1>Data Reservasi</h1>
@stop

@section('content')
    <blockquote class="quote-olive">
        <h5 class="text-olive">Tips!</h5>
        <p>
            <i class="fa-solid fa-cart-shopping"></i> <b>Bayar</b> untuk mengisi bukti transfer
            <br>
            <i class="fa-solid fa-pen-to-square fa-fw"></i> <b>Edit</b> untuk mengubah data
            <br>
            <i class="fa-solid fa-trash fa-fw"></i> <b>Hapus</b> untuk menghapus data reservasi tersebut
        </p>
    </blockquote>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="user_table" class="display table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">No HP</th>
                            <th class="text-center">Reservasi ID</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasis as $reservasi)
                        <tr>
                            {{-- Kolom - No --}}
                            <td></td>
                            {{-- Kolom - Status --}}
                            <td class="">
                                {{-- Switch untuk membedakan warna text sesuai status --}}
                                @switch($reservasi->status)
                                    @case('Pending')
                                        <div class="badge badge-secondary text-wrap" style="width: 5rem;">
                                            Pending
                                        </div>
                                        @break
                                    @case('Menunggu Pembayaran')
                                        <div class="badge badge-warning text-wrap" style="width: 5rem;">
                                            Menunggu Pembayaran
                                        </div>
                                        @break
                                    @case('Proses Acc Admin')
                                        <div class="badge badge-primary text-wrap" style="width: 5rem;">
                                            Proses Acc Admin
                                        </div>
                                        @break
                                    @case('Berhasil')
                                        <div class="badge badge-success text-wrap" style="width: 5rem;">
                                            Berhasil
                                        </div>
                                        @break
                                    @case('Ditolak')
                                        <div class="badge badge-danger text-wrap" style="width: 5rem;">
                                            Ditolak
                                        </div>
                                        @break
                                @endswitch
                            </td>
                            {{-- Kolom - Tanggal --}}
                            <td class=""><b>{{$reservasi->tanggal}}</b><br><i>{{ $reservasi->jam_awal }}-{{ $reservasi->jam_akhir }}</i></td>
                            {{-- Kolom - Harga --}}
                            <td class="">Rp {{ $reservasi->harga }}<br>({{ $reservasi->durasi }} Jam)</td>
                            {{-- Kolom - No HP --}}
                            <td class="">{{ $reservasi->no_hp }}</td>
                            {{-- Kolom - Reservasi ID --}}
                            <td class="">{{ $reservasi->reservasi_id }}</td>
                            {{-- Kolom - Aksi --}}
                            {{-- Disabled sesuai status --}}
                            <td>
                                <div class="btn-group">
                                    {{-- Aksi Conditional --}}
                                    {{-- Admin Side --}}
                                    @if (Auth::user()->is_admin == 1)
                                        {{-- Button Tampilkan Pembayaran --}}
                                        {{-- Hanya untuk status Proses Acc Admin dan Berhasil --}}
                                        <button type="button" class="btn
                                                @if ($reservasi->status == 'Proses Acc Admin'
                                                or $reservasi->status == 'Berhasil')
                                                    btn-success"
                                                @else
                                                    btn-secondary" disabled
                                        @endif>
                                            <i class="fa-solid fa-money-bill-transfer"></i>
                                        </button>

                                        {{-- Button Edit untuk mengubah status --}}
                                        <button type="button" class="btn btn-warning">
                                            <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                        </button>

                                        {{-- Button Hapus --}}
                                        <form method="POST" action="{{ route('reservasi.delete', $reservasi->reservasi_id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>
                                                <i class="fa-solid fa-trash fa-fw"></i>
                                            </button>
                                        </form>
                                    @else

                                        {{-- User Side --}}
                                        {{-- Pembayaran --}}
                                        {{-- Hanya bisa bayar jika status Menunggu Pembayaran--}}
                                        <button type="button" class="btn modalBayar
                                                @if ($reservasi->status != 'Menunggu Pembayaran')
                                                    btn-secondary" disabled
                                                @else
                                                    btn-success" data-toggle="modal" data-target="#modalBayar" data-id='{{ $reservasi->reservasi_id }}'
                                                @endif >
                                            <i class="fa-solid fa-money-bill-transfer"></i>
                                        </button>

                                        {{-- Edit Reservasi --}}
                                        {{-- Hanya bisa dilakukan di status Pending dan Menunggu Pembayaran --}}
                                        <a href="{{url('edit-reservasi/'.$reservasi->reservasi_id)}}"  class="btn
                                            @if ($reservasi->status == 'Pending' or $reservasi->status == 'Menunggu Pembayaran')
                                                btn-warning"
                                            @else
                                                btn-secondary disabled" aria-disabled="true"
                                            @endif>
                                            <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                        </a>

                                        {{-- Hapus Reservasi --}}
                                        {{-- Clickable untuk status Pending, Menunggu Pembayaran, Ditolak --}}
                                        <form method="POST" action="{{ route('reservasi.delete', $reservasi->reservasi_id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                                <button type="button" data-toggle="tooltip" title='Delete' class="btn
                                                    @if ($reservasi->status == 'Proses Acc Admin'
                                                        or $reservasi->status == 'Berhasil')
                                                        btn-secondary" disabled
                                                    @else
                                                        btn-danger show_confirm"
                                                    @endif>
                                                    <i class="fa-solid fa-trash fa-fw"></i>
                                                </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="{{url('pembayaran')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify">
                            <div class="col">
                                {{-- Reservasi ID (KHUSUS BAYAR) --}}
                                <div class="form-group row mb-2">
                                    <label for="reservasiID_bayar" class="col-form-label">Reservasi ID</label>
                                    <input type="number" id="reservasiID_bayar" name="reservasiID_bayar" class="form-control" readonly required>
                                </div>
                                {{-- Atas Nama Rekening --}}
                                <div class="form-group row mb-2">
                                    <label for="atas_nama" class="col-form-label">Atas Nama Rekening</label>
                                    <input type="text" id="atas_nama" name="atas_nama" class="form-control" required>
                                </div>
                                {{-- Jenis Pembayaran --}}
                                <div class="form-group row mb-2">
                                    <label for="jenis_bayar" class="col-form-label">Jenis Pembayaran</label>
                                    <select name="jenis_bayar" id="jenis_bayar" class="form-control">
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="Shopeepay">Shopeepay</option>
                                    </select>
                                </div>
                                {{-- Upload Bukti Pembayaran --}}
                                <div class="form-group row mb-2">
                                    <label for="" class="col-form-label">Bukti Pembayaran</label>
                                    <div class="custom-file">
                                        <input type="file" id="bukti_bayar" name="bukti_bayar" class="w-auto custom-file-input" required>
                                        <label class="custom-file-label" for="bukti_bayar">Pilih file gambar atau pdf...</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@stop

@section('js')
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    {{-- Data Table Konfigurasi --}}
    <script>
        $(document).ready( function () {
            var t = $('#user_table').DataTable({

                columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: [0,6], //No dan Aksi tidak bisa disorting dan search
                    },
                    { className: "align-middle", "targets": [ 0,1,2,3,4,5,6 ] }, //Vertical Alignment
                    { className: "text-center", "targets": [ 0,1,5,6 ] }, //Horizontal Alignment
                    { "width": "5%", "targets": 5 },
                    { "width": "5%", "targets": 1 },
                ],
                order: [[2, 'asc']], // Order dari Tanggal
                language: { // Ubah bahasa tabel ke indonesia
                    url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/id.json'
                }

            });

            // Fungsi biar iterasi di No.
            t.on('order.dt search.dt', function () {
                let i = 1;

                t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                    this.data(i++);
                });
            }).draw();
        } );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    {{-- Delete Confirmation - Sweet Alert 2  --}}
    <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: `Apakah anda yakin ingin menghapus reservasi itu?`,
                    text: "Jika kamu hapus, data itu akan hilang selamanya.",
                    icon: "warning",
                    buttons: ["Batal", "Hapus!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
                });
            });

    </script>

    {{-- Modal Bayar --}}
    <script>
         $('.modalBayar').click(function(event) {
            var myReservasiID = $(this).attr('data-id');
            $(".modal-body #reservasiID_bayar").val( myReservasiID );
        });
    </script>

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
