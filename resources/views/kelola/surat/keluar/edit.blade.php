@extends('adminlte::page')

@section('title', 'Edit Surat Keluar')

@section('content_header')
    <h1>Edit Surat Keluar</h1>
@stop

@section('plugins.TempusDominus', true)
@section('plugins.bsCustomFileInput', true)

@section('content')
    <div class="col-md-6" style="float:none;margin:auto;">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Form Edit</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="{{ redirect()->getUrlGenerator()->route('index.surat.keluar') }}">
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
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Error!</h5>
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    @csrf
                    <x-adminlte-input-date name="tanggal_keluar" value="{{ old('tanggal_keluar') ?? $tanggal_keluar }}"
                                           :config="$conf_tglsurat" placeholder="Masukkan Tanggal Keluar..."
                                           label="Tanggal Keluar">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                    <x-adminlte-input name="bidang" value="{{ old('bidang') ?? $data->bidang }}" label="Bidang"
                                      placeholder="Masukkan Bidang..."/>
                    <x-adminlte-input name="nomor_surat" value="{{ old('nomor_surat') ?? $data->nomor_surat }}" label="Nomor Surat"
                                      placeholder="Masukkan Nomor Surat..."/>
                    <x-adminlte-input-date name="tanggal_surat" value="{{ old('tanggal_surat') ?? $tanggal_surat }}"
                                           :config="$conf_tglsurat" placeholder="Masukkan Tanggal Surat..."
                                           label="Tanggal Surat">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                    <x-adminlte-input name="kepada" value="{{ old('kepada') ?? $data->kepada }}" label="Kepada"
                                      placeholder="Masukkan Kepada..."/>
                    <x-adminlte-textarea name="perihal" label="Perihal" placeholder="Perihal...">
                        {{ old('perihal') ?? $data->perihal }}
                    </x-adminlte-textarea>
                    @if($data->file)
                        <x-adminlte-input-file name="file" label="Upload File Surat" placeholder="{{ old('file') ?? $data->file }}"
                                               disable-feedback/>
                    @else
                        <x-adminlte-input-file name="file" label="Upload File Surat" placeholder="Pilih File..."
                                               disable-feedback/>
                    @endif
                    <x-adminlte-input value="{{ $data->operator }}" name="operator" label="Operator" readonly/>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css')
@endpush

@push('js')
@endpush
