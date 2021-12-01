@extends('adminlte::page')

@section('title', 'Tambah Pengguna')

@section('content_header')
    <h1>Tambah Pengguna</h1>
@stop

@section('plugins.Select2', true)

@section('content')
    <div class="col-md-6" style="float:none;margin:auto;">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Form Tambah</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="{{ redirect()->getUrlGenerator()->route('index.user') }}">
                            <button type="button" class="btn btn-primary">Kembali</button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url()->current()}}/post" method="post">
                <div class="card-body">
                    @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <x-adminlte-input value="{{ old('username') }}" name="username" label="Username" placeholder="Masukkan Username..."/>
                    <x-adminlte-input value="{{ old('nama') }}" name="nama" label="Nama" placeholder="Masukkan Nama..."/>
                    <x-adminlte-input value="{{ old('nip') }}" name="nip" label="NIP" placeholder="Masukkan NIP..."/>
                    <x-adminlte-select2 name="peran" label="Peran" data-placeholder="Pilih Peran...">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        @foreach($roles as $list)
                            <option
                                value="{{ Crypt::encrypt($list->id) }}">{{ $list->name }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    <x-adminlte-input type="password" name="password" label="Password"
                                      placeholder="Masukkan Password..."/>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css')
@endpush

@push('js')
@endpush
