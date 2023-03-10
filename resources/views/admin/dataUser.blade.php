@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data Akun User</h1>
@stop

@section('content')
    <blockquote class="quote-olive">
        <h5 class="text-olive">Tips!</h5>
        <p>
            <i class="fa-solid fa-pen-to-square fa-fw"></i> <b>Edit</b> untuk mengubah data dan verifikasi manual
            <br>
            <i class="fa-solid fa-trash fa-fw"></i> <b>Hapus</b> untuk menghapus data user tersebut
        </p>
    </blockquote>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="user_table" class="display table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">ID Akun</th>
                            <th class="text-center">Verifikasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            {{-- Kolom 0 - No --}}
                            <td></td>
                            {{-- Kolom 1 - Nama --}}
                            <td class="">{{ $user->name }}</td>
                            {{-- Kolom 2 - Email --}}
                            <td class="">{{ $user->email }}</td>
                            {{-- Kolom 3 - Role --}}
                            <td>
                                @if($user->is_admin == true)
                                   <strong class="text-success">Admin</strong>
                                @else
                                    Pelanggan
                                @endif
                            </td>
                            <td class="">{{ $user->id }}</td>
                            {{-- Kolom 4 - Verifikasi --}}
                            <td>
                                @if ($user->email_verified_at == NULL)
                                    <i class="fa-solid fa-circle-xmark text-danger fa-xl"></i>
                                @else
                                    <i class="fa-solid fa-circle-check text-primary fa-xl"></i>
                                @endif
                            </td>
                            {{-- Kolom 5 - Aksi --}}
                            <td>
                                <div class="btn-group">
                                    {{-- Edit User --}}
                                    <a href="{{ url('admin/edit-user/'.$user->id) }}"  class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                    </a>

                                    {{-- Hapus User --}}
                                    {{-- Tidak bisa dilakukan oleh akun aktif --}}
                                    <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" class="btn
                                            @if ($user->id != Auth::user()->id)
                                                btn-danger show_confirm" data-toggle="tooltip" title='Delete'
                                            @else
                                                btn-secondary" disabled
                                            @endif>
                                            <i class="fa-solid fa-trash fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/f68e3b150b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            var t = $('#user_table').DataTable({
                columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: 0, //No tidak bisa disorting dan search
                    },
                    { orderable: false, targets: 5 }, //Aksi tidak bisa disorting

                    { className: "align-middle", "targets": [ 0,1,2,3,4,5,6 ] }, //Vertical Alignment
                    { className: "text-center", "targets": [ 0,3,4,5,6 ] }, //Horizontal Alignment
                ],
                order: [[1, 'asc']], // Order dari Nama
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
    <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: `Apakah anda yakin ingin menghapus Akun itu?`,
                    text: "Jika kamu hapus, akun itu akan hilang selamanya.",
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
@stop
