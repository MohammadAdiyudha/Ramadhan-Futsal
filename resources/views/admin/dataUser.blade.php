@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data Akun User</h1>
@stop

@section('content')

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
                    <td class="text-center"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin == true)
                           <strong class="text-success">Admin</strong>
                        @else
                            User
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($user->email_verified_at == NULL)
                            <i class="fa-solid fa-circle-xmark text-danger"></i>
                        @else
                            <i class="fa-solid fa-circle-check text-primary"></i>
                        @endif
                    </td>
                    {{-- Aksi Button Group --}}
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square fa-fw"></i>Edit
                            </button>
                            <button type="button" class="btn btn-danger">
                                <i class="fa-solid fa-trash fa-fw"></i>Hapus
                            </button>
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
