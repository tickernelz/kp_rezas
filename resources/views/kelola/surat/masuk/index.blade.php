@extends('adminlte::page')

@section('title', 'List Pengguna')

@section('content_header')
    <h1>List Surat Masuk</h1>
@stop

@section('plugins.Datatables', true)

@php
    $heads = [
        'No Urut',
        'Tanggal Masuk',
        'Kode Surat',
        'Tanggal Surat',
        'Pengirim',
        'Nomor Surat',
        'Kepada',
        'Perihal',
        'Aksi',
    ];

$config = [
    'order' => [[0, 'asc']],
    'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false, 'className' => 'text-center']],
];
@endphp

@section('content')
    <x-adminlte-datatable id="table" :config="$config" :heads="$heads" striped hoverable bordered>
        @foreach($data as $li)
            <tr>
                <td>{!! $li->nomor_urut !!}</td>
                <td>{!! $li->tanggal_masuk !!}</td>
                <td>{!! $li->kode !!}</td>
                <td>{!! $li->tanggal_surat !!}</td>
                <td>{!! $li->pengirim !!}</td>
                <td>{!! $li->nomor_surat !!}</td>
                <td>{!! $li->kepada !!}</td>
                <td>{!! $li->perihal !!}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <a type="button" class="btn btn-secondary"
                           href="{{ Request::url() }}/edit/{{$li->id}}">
                            <i class="fa fa-edit"></i>
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
@stop

