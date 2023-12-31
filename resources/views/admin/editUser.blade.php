@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <blockquote class="quote-warning">
        <h5 class="text-warning">Tips!</h5>
        <p>
            <i class="fa-solid fa-lock"></i> <strong>Password</strong> hanya bisa diubah oleh pemilih Akun
        </p>
    </blockquote>

    <div class="container">
        <div class="row">
            <div class="col-md-7">

                <div class="card">
                    <div class="card-body">

                        <form action="{{ url('admin/update-user/'.$user->id) }}" method="POST">
                            @csrf
                            {{-- Kolom Nama --}}
                            <div class="form-group row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror">
                                    {{-- Jika ada error dari controller --}}
                                    @error('name')
                                        <div id="validationServer05Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Kolom Email --}}
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror">
                                    {{-- Jika ada error dari controller --}}
                                    @error('email')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Kolom Role --}}
                            <div class="form-group row mb-3">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" class="form-select col-sm-12">
                                        <option value=1 <?php echo $user['is_admin'] == 1 ? ' selected ' : '';?>>Admin</option>
                                        <option value=0 <?php echo $user['is_admin'] == 0 ? ' selected ' : '';?>>Pelanggan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Kolom Verifikasi --}}
                            {{-- Dengan Kondisi Belum Verifikasi --}}
                            @if ($user->email_verified_at == NULL)
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="verifikasi" id="verifikasi" value="a" class="form-check-input">
                                    <label for="verifikasi" class="form-check-label">Verifikasi Email</label>
                                </div>
                            @endif
                            {{-- Tombol Submit --}}
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>

                        </form>

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
