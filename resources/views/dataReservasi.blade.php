@extends('adminlte::page')

@section('title', 'Data Reservasi')

@section('content_header')
    <h1>Data Reservasi</h1>
@stop

@section('content')
    <blockquote class="quote-info">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-info">Tips! Tekan Tombol Berikut</h5>
                    <p class="text-justify">
                        {{-- TIPS ADMIN --}}
                        @if (Auth::user()->is_admin == 1)
                            <a tabindex="0"
                                role="button"
                                class="btn btn-dark"
                                data-toggle="popover"
                                title="Fungsi Setiap Tombol Aksi"
                                data-html="true"
                                data-trigger="focus"
                                data-placement="bottom"
                                data-content="<i class='fa-solid fa-money-bill-transfer fa-fw text-success'></i>
                                                    untuk melihat bukti transfer
                                                <br>
                                                <i class='fa-solid fa-pen-to-square fa-fw text-warning'></i>
                                                    untuk mengubah status reservasi
                                                <br>
                                                <i class='fa-solid fa-trash fa-fw text-danger'></i>
                                                    untuk menghapus data reservasi">
                                <b>Fungsi Tombol Aksi</b>
                            </a>
                            <a tabindex="0"
                                role="button"
                                class="btn btn btn-success"
                                data-toggle="popover"
                                title="Cara Buat Laporan Bulanan"
                                data-html="true"
                                data-trigger="focus"
                                data-placement="bottom"
                                data-content="<ol class='text-justify'>
                                                <li>Ketik dengan format <b>Berhasil Tahun-Bulan</b> pada Kolom <b>Cari</b>. <br>Contoh : <b>Berhasil 2023-03</b> untuk menampilkan laporan bulan Maret 2023</li>
                                                <li>Lalu tekan <b>Tombol Buat Laporan</b> dan Pilih Format Laporan</li>
                                            </ol>">
                                <b>Cara Buat Laporan Bulanan</b>
                            </a>

                        {{-- TIPS USER --}}
                        @else
                            <a tabindex="0"
                                role="button"
                                class="btn btn btn-info"
                                data-toggle="popover"
                                title="Kegunaan Tombol Aksi"
                                data-html="true"
                                data-trigger="focus"
                                data-placement="bottom"
                                data-content="<i class='fa-solid fa-money-bill-transfer fa-fw text-success'></i>
                                                    untuk mengisi bukti transfer
                                                <br>
                                                <i class='fa-solid fa-pen-to-square fa-fw text-warning'></i>
                                                    untuk mengubah detail reservasi
                                                <br>
                                                <i class='fa-solid fa-trash fa-fw text-danger'></i>
                                                    untuk menghapus data reservasi">
                                <b>Kegunaan Tombol Aksi</b>
                            </a>

                        @endif
                    </p>
                </div>
            </div>
        </div>

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
                            <th class="text-center">Nama Pemesan</th>
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
                                        <div class="badge badge-secondary text-wrap" style="width: 5rem;"
                                        data-toggle="tooltip" data-placement="top" title="Admin Sedang Memastikan Jadwal Tersedia">
                                            Pending
                                        </div>
                                        @break
                                    @case('Menunggu Pembayaran')
                                        <div class="badge badge-warning text-wrap" style="width: 5rem;"
                                        data-toggle="tooltip" data-placement="top" title="Jadwal Tersedia, Silahkan Membayar Untuk Melanjutkan">
                                            Menunggu Pembayaran
                                        </div>
                                        @break
                                    @case('Proses Acc Admin')
                                        <div class="badge badge-primary text-wrap" style="width: 5rem;"
                                        data-toggle="tooltip" data-placement="top" title="Pembayaran Masuk, Admin Sedang Konfirmasi Pembayaran">
                                            Proses Acc Admin
                                        </div>
                                        @break
                                    @case('Berhasil')
                                        <div class="badge badge-success text-wrap" style="width: 5rem;"
                                        data-toggle="tooltip" data-placement="top" title="Pembayaran Valid, Silahkan Datang Sesuai Jadwal">
                                            Berhasil
                                        </div>
                                        @break
                                    @case('Ditolak')
                                        <div class="badge badge-danger text-wrap" style="width: 5rem;"
                                        data-toggle="tooltip" data-placement="top" title="Jadwal Tersebut Penuh / Pembayaran Tidak Valid">
                                            Ditolak
                                        </div>
                                        @break
                                @endswitch
                            </td>
                            {{-- Kolom - Tanggal --}}
                            <td class=""><b>{{$reservasi->tanggal}}</b>&nbsp;<br><i>({{ $reservasi->jam_awal }}-{{ $reservasi->jam_akhir }})</i></td>
                            {{-- Kolom - Harga --}}
                            <td class="">Rp{{ $reservasi->harga }}</td>
                            {{-- Kolom - No HP --}}
                            <td class="">{{ $reservasi->no_hp }}</td>
                            {{-- Kolom - Reservasi ID --}}
                            <td class="">{{ $reservasi->reservasi_id }}</td>
                            {{-- Kolom - Nama Pemesan --}}
                            {{-- @ Digunakan untuk tetap menerima nilai NULL --}}
                            <td class="">{{ @$reservasi->user->name }}</td>
                            {{-- Kolom - Aksi --}}
                            {{-- Disabled sesuai status --}}
                            <td>
                                <div class="btn-group">
                                    {{-- Admin Side --}}
                                    @if (Auth::user()->is_admin == 1)
                                        {{-- Button Tampilkan Pembayaran --}}
                                        {{-- Hanya untuk status Proses Acc Admin dan Berhasil --}}
                                        <a href="{{url('admin/lihat-pembayaran/'.$reservasi->reservasi_id)}}" class="btn
                                                @if ($reservasi->status == 'Proses Acc Admin'
                                                or $reservasi->status == 'Berhasil')
                                                    btn-success"
                                                @else
                                                    btn-secondary disabled" aria-disabled="true"
                                                @endif>
                                            <i class="fa-solid fa-money-bill-transfer"></i>
                                         </a>

                                        {{-- Button Edit untuk mengubah status --}}
                                        <button type="button" class="btn btn-warning openModalSetStatus" data-toggle="modal" data-target="#modalSetStatus" data-id='{{ $reservasi->reservasi_id }}' data-status='{{ $reservasi->status }}'>
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
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Total Pemasukan :</th>
                            <th style="text-align:left"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal - Upload Pembayaran -->
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
                                        <option value="Mandiri">Mandiri : 113-556-33743</option>
                                        <option value="Shopeepay">Shopeepay : 0811223344</option>
                                        <option value="Gopay">Gopay : 0811223344</option>
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


    <!-- Modal - Set Status -->
    <div class="modal fade" id="modalSetStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Status Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="{{url('admin/set-status')}}" method="POST">
                        @csrf
                        <div class="row justify">
                            <div class="col">
                                {{-- Reservasi ID (KHUSUS BAYAR) --}}
                                <div class="form-group row mb-2">
                                    <label for="stReservasiID" class="col-form-label">Reservasi ID</label>
                                    <input type="number" id="stReservasiID" name="stReservasiID" class="form-control" readonly required>
                                </div>
                                {{-- Atas Nama Rekening --}}
                                <div class="form-group row mb-2">
                                    <label for="setStatus" class="col-form-label">Status Reservasi</label>
                                    <select class="custom-select" id="setStatus" name="setStatus"">
                                        <option value="Pending">Pending</option>
                                        <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                        <option value="Proses Acc Admin">Proses Acc Admin</option>
                                        <option value="Berhasil">Berhasil</option>
                                        <option value="Ditolak">Ditolak</option>
                                      </select>
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
    <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/datatables.min.css" rel="stylesheet"/>
@stop

@section('js')
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/datatables.min.js"></script>

    {{-- Data Table Konfigurasi --}}
    <script>
        $(document).ready( function () {
            var t = $('#user_table').DataTable({
                columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: [0,7], //No dan Aksi tidak bisa disorting dan search
                    },
                    { className: "align-middle", "targets": [ 0,1,2,3,4,5,6,7 ] }, //Vertical Alignment
                    { className: "text-center", "targets": [ 0,1,5,6,7 ] }, //Horizontal Alignment
                    // Lebar Kolom
                    { "width": "5%", "targets": [0,1,5,6,7] },
                    { "width": "10em", "targets": [2,3] },
                ],
                order: [[2, 'asc']], // Order dari Tanggal
                language: { // Ubah bahasa tabel ke indonesia
                    url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/id.json'
                },
                // Tampilkan xxx Entri
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'Semua'],
                ],

                // Footer untuk Total
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Hapus Rp dan hanya return harga
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\Rp,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // Total Seluruh Status Semua Halaman
                    total = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total Seluruh Status Halaman AKTIF
                    pageTotal = api
                        .column(3, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(3).footer()).html('Rp' + pageTotal);
                },
                // Layouting
                dom: 'Bfrtlp',

                // Konfigurasi Button
                buttons: [
                    {
                        extend: 'collection', // Group Button
                        text: 'Buat Laporan', // Caption
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                text: 'Excel',
                                exportOptions: {
                                    columns: [ 0,1,2,3,4,5,6 ],
                                    modifier: {
                                        page: 'all', // Agar menghitung Total Seluruh Halaman
                                    }
                                },
                                footer: true, // Agar Footer Termasuk
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                exportOptions: {
                                    columns: [ 0,1,2,3,4,5,6 ],
                                    modifier: {
                                        page: 'all',  // Agar menghitung Total Seluruh Halaman
                                    }
                                },
                                footer: true, // Agar Footer Termasuk
                            },
                        ]
                    }
                ],
            });

            // Fungsi biar iterasi otomatis di No.
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

    {{-- Modal - Passing Data--}}
    <script>
        // Modal Bayar
         $('.modalBayar').click(function(event) {
            var myReservasiID = $(this).attr('data-id');
            $(".modal-body #reservasiID_bayar").val( myReservasiID );
        });

        // Modal Set Status
        $('.openModalSetStatus').click(function(event) {
            var sttReservasiID = $(this).attr('data-id');
            var sttStatus      = $(this).attr('data-status');
            $(".modal-body #stReservasiID").val( sttReservasiID );
            $(".modal-body #setStatus").val( sttStatus );
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

    {{-- Memanggil Tooltip Keterangan Setiap Status --}}
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(function () {
            $('[data-toggle="popover"]').popover()
        })

        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
    </script>
@stop
