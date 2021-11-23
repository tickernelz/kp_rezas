@extends('adminlte::page')

@section('title', 'Tambah Surat Masuk')

@section('content_header')
    <h1>Tambah Surat Masuk</h1>
@stop

@section('plugins.TempusDominus', true)
@section('plugins.bsCustomFileInput', true)

@section('content')
    <div class="col-md-6" style="float:none;margin:auto;">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Form Tambah</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="{{ redirect()->getUrlGenerator()->route('index.surat.masuk') }}">
                            <button type="button" class="btn btn-primary">Kembali</button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url()->current()}}/post" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @csrf
                    <x-adminlte-input-date value="{{ old('tanggal_masuk') }}" name="tanggal_masuk" :config="$conf_tglsurat"
                                           placeholder="Masukkan Tanggal Masuk..." label="Tanggal Masuk">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                    <x-adminlte-input value="{{ old('kode') }}" name="kode" label="Bidang" placeholder="Masukkan Bidang..."/>
                    <x-adminlte-input value="{{ old('nomor_urut') }}" name="nomor_urut" label="Nomor Urut" placeholder="Masukkan Nomor Urut..."/>
                    <x-adminlte-input value="{{ old('nomor_surat') }}" name="nomor_surat" label="Nomor Surat" placeholder="Masukkan Nomor Surat..."/>
                    <x-adminlte-input-date value="{{ old('tanggal_surat') }}" name="tanggal_surat" :config="$conf_tglsurat"
                                           placeholder="Masukkan Tanggal Surat..." label="Tanggal Surat">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                    <x-adminlte-input value="{{ old('pengirim') }}" name="pengirim" label="Pengirim" placeholder="Masukkan Pengirim..."/>
                    <x-adminlte-input value="{{ old('kepada') }}" name="kepada" label="Kepada" placeholder="Masukkan Kepada..."/>
                    <x-adminlte-textarea value="{{ old('perihal') }}" name="perihal" label="Perihal" placeholder="Perihal..."/>
                    <x-adminlte-input-file name="file" label="Upload File Surat" placeholder="Pilih File..."
                                           disable-feedback/>
                    <x-adminlte-input value="{{ $user->nama }}" name="operator" label="Operator" readonly/>
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
