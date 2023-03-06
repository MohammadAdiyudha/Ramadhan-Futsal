@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Edit & Update User
                            <a href="{{ url('index') }}" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('admin/update/'.$user->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{$user->email}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Role</label>
                                <select name="test">
                                    <option value="1" <?php echo $user['is_admin'] == 1 ? ' selected ' : '';?>>Admin</option>
                                    <option value="0" <?php echo $user['is_admin'] == 0 ? ' selected ' : '';?>>Pelanggan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Update User</button>
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
