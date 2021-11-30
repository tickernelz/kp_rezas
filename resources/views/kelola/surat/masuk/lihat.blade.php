@extends('adminlte::page')

@section('title', 'Detail Surat Masuk')

@section('content_header')
    <h1>Detail Surat Masuk</h1>
@stop

@section('plugins.TempusDominus', true)
@section('plugins.bsCustomFileInput', true)

@section('content')
    <div class="col-md-6" style="float:none;margin:auto;">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Detail</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a href="{{ redirect()->getUrlGenerator()->route('index.surat.masuk') }}">
                            <button type="button" class="btn btn-primary">Kembali</button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body">
                <p class="lead">Nomor Surat {{ $data->nomor_surat }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Tanggal Masuk:</th>
                            <td>{{ $data->tanggal_masuk }}</td>
                        </tr>
                        <tr>
                            <th>Bidang:</th>
                            <td>{{ $data->bidang }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Surat:</th>
                            <td>{{ $data->nomor_surat }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Surat:</th>
                            <td>{{ $data->tanggal_surat }}</td>
                        </tr>
                        <tr>
                            <th>Pengirim:</th>
                            <td>{{ $data->pengirim }}</td>
                        </tr>
                        <tr>
                            <th>Kepada:</th>
                            <td>{{ $data->kepada }}</td>
                        </tr>
                        <tr>
                            <th>Perihal:</th>
                            <td>{{ $data->perihal }}</td>
                        </tr>
                        <tr>
                            <th>File:</th>
                            @if (isset($data->file))
                                <td><a href="/file/{{$data->file}}"><b>Lihat & Unduh File</b></a></td>
                            @else
                                <td><b>File Tidak Tersedia!</b></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Operator:</th>
                            <td>{{ $data->operator }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Entry:</th>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            </form>
        </div>
    </div>
@stop

@push('css')
@endpush

@push('js')
@endpush
