@extends('adminlte::page')

@section('title', 'List Surat Masuk')

@section('content_header')
    <h1>List Surat Masuk ({{ Auth::user()->bidang }})</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.TempusDominus', true)

@php
    $heads = [
        'Tanggal Masuk',
        'Tanggal Surat',
        'Pengirim',
        'Nomor Surat',
        'Kepada',
        'Perihal',
        'File',
        'Aksi',
    ];

$config = [
    'order' => [[0, 'asc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false, 'className' => 'text-center'], ['orderable' => false, 'className' => 'text-center']],
];
@endphp

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Filter Tanggal Masuk Surat
            </h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('cari.surat.masuk') }}" method="get" enctype="multipart/form-data">
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation"></i> Error</h5>
                        {{ Session::get('error') }}
                    </div>
                @endif
                <x-adminlte-input-date value="{{ Request::get('tanggal_awal') ?? old('tanggal_awal') }}" name="tanggal_awal"
                                       :config="$conf_tglsurat"
                                       placeholder="Masukkan Tanggal Awal..." label="Tanggal Awal">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-date>
                <x-adminlte-input-date value="{{ Request::get('tanggal_akhir') ?? old('tanggal_akhir') }}" name="tanggal_akhir"
                                       :config="$conf_tglsurat"
                                       placeholder="Masukkan Tanggal Akhir..." label="Tanggal Akhir">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-date>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Tabel
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <x-adminlte-datatable id="table" :config="$config" :heads="$heads" hoverable bordered beautify>
                @foreach($data as $li)
                    <tr>
                        <td>{!! $li->tanggal_masuk !!}</td>
                        <td>{!! $li->tanggal_surat !!}</td>
                        <td>{!! $li->pengirim !!}</td>
                        <td>{!! $li->nomor_surat !!}</td>
                        <td>{!! $li->kepada !!}</td>
                        <td>{!! $li->perihal !!}</td>
                        <td>
                            @if (isset($li->file))
                                <div class="btn-group btn-group-sm" role="group">
                                    <a type="button" class="btn btn-sm btn-secondary"
                                       href="/file/{{$li->file}}">
                                        Lihat
                                    </a>
                                    <a type="button" class="btn btn-sm btn-secondary"
                                       href="{{ Request::url() }}/hapus-berkas/{{$li->id}}"
                                       onclick="return confirm('Yakin Mau Dihapus?');">
                                        Hapus
                                    </a>
                                </div>
                            @else
                                Tidak Ada Berkas
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a type="button" class="btn btn-secondary"
                                   href="{{ Request::url() }}/edit/{{$li->id}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="btn btn-secondary"
                                   href="{{ Request::url() }}/lihat/{{$li->id}}">
                                    <i class="fa fa-file-archive"></i>
                                </a>
                                <a type="button" class="btn btn-secondary"
                                   href="{{ Request::url() }}/hapus/{{$li->id}}"
                                   onclick="return confirm('Yakin Mau Dihapus?');">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
        <!-- /.card-body -->
    </div>
@stop

