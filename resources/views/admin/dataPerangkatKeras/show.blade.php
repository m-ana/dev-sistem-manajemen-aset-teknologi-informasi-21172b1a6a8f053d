@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataPerangkatKera.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-perangkat-keras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nomor_rak') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nomor_rak->nomor ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nama_merk') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nama_merk->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nama_jenis') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nama_jenis->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.tipe') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->tipe }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.serial_number') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->serial_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.tahun_beli') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->tahun_beli }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nomor_u') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nomor_u }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.ip') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->ip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.tahun_berakhir_garansi') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->tahun_berakhir_garansi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nomor_u_kosong') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nomor_u_kosong }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.foto') }}
                        </th>
                        <td>
                            @foreach($dataPerangkatKera->foto as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.kontak_pic') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->kontak_pic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nama_status') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nama_status->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.nama_lokasi') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->nama_lokasi->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPerangkatKera.fields.ruang_panel') }}
                        </th>
                        <td>
                            {{ $dataPerangkatKera->ruang_panel }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-perangkat-keras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection