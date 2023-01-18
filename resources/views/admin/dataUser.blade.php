@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data Akun User</h1>
@stop

@section('content')
    <blockquote class="quote-olive">
        <h5 class="text-olive">Tips!</h5>
        <p>
            <i class="fa-solid fa-pen-to-square fa-fw"></i> edit untuk mengubah data dan verifikasi manual
            <br>
            <i class="fa-solid fa-trash fa-fw"></i> hapus untuk menghapus data user tersebut
        </p>
    </blockquote>

    <div class="table-responsive">
        <table id="user_table" class="display table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Verifikasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center align-middle"></td>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>

                    <td class="align-middle">
                        @if($user->is_admin == true)
                           <strong class="text-success">Admin</strong>
                        @else
                            User
                        @endif
                    </td>

                    <td class="text-center align-middle">
                        @if ($user->email_verified_at == NULL)
                            <i class="fa-solid fa-circle-xmark text-danger fa-xl"></i>
                        @else
                            <i class="fa-solid fa-circle-check text-primary fa-xl"></i>
                        @endif
                    </td>
                    {{-- Aksi Button Group --}}
                    <td class="text-center align-middle">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square fa-fw"></i>Edit
                            </button>
                            @if ($user->id != Auth::user()->id) {{--Biar tidak bisa hapus akun sendiri--}}
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash fa-fw"></i>Hapus
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                        targets: 0,
                    },
                    { orderable: false, targets: 5 }, //Aksi tidak bisa di sorting
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
@stop
