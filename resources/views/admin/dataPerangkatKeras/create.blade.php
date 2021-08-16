@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dataPerangkatKera.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-perangkat-keras.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nomor_rak_id">{{ trans('cruds.dataPerangkatKera.fields.nomor_rak') }}</label>
                <select class="form-control select2 {{ $errors->has('nomor_rak') ? 'is-invalid' : '' }}" name="nomor_rak_id" id="nomor_rak_id" required>
                    @foreach($nomor_raks as $id => $entry)
                        <option value="{{ $id }}" {{ old('nomor_rak_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nomor_rak'))
                    <span class="text-danger">{{ $errors->first('nomor_rak') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nomor_rak_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_merk_id">{{ trans('cruds.dataPerangkatKera.fields.nama_merk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_merk') ? 'is-invalid' : '' }}" name="nama_merk_id" id="nama_merk_id" required>
                    @foreach($nama_merks as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_merk_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_merk'))
                    <span class="text-danger">{{ $errors->first('nama_merk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nama_merk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_jenis_id">{{ trans('cruds.dataPerangkatKera.fields.nama_jenis') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_jenis') ? 'is-invalid' : '' }}" name="nama_jenis_id" id="nama_jenis_id">
                    @foreach($nama_jenis as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_jenis_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_jenis'))
                    <span class="text-danger">{{ $errors->first('nama_jenis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nama_jenis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tipe">{{ trans('cruds.dataPerangkatKera.fields.tipe') }}</label>
                <input class="form-control {{ $errors->has('tipe') ? 'is-invalid' : '' }}" type="text" name="tipe" id="tipe" value="{{ old('tipe', '') }}">
                @if($errors->has('tipe'))
                    <span class="text-danger">{{ $errors->first('tipe') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.tipe_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serial_number">{{ trans('cruds.dataPerangkatKera.fields.serial_number') }}</label>
                <input class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', '') }}">
                @if($errors->has('serial_number'))
                    <span class="text-danger">{{ $errors->first('serial_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.serial_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahun_beli">{{ trans('cruds.dataPerangkatKera.fields.tahun_beli') }}</label>
                <input class="form-control {{ $errors->has('tahun_beli') ? 'is-invalid' : '' }}" type="number" name="tahun_beli" id="tahun_beli" value="{{ old('tahun_beli', '') }}" step="1">
                @if($errors->has('tahun_beli'))
                    <span class="text-danger">{{ $errors->first('tahun_beli') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.tahun_beli_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nomor_u">{{ trans('cruds.dataPerangkatKera.fields.nomor_u') }}</label>
                <input class="form-control {{ $errors->has('nomor_u') ? 'is-invalid' : '' }}" type="text" name="nomor_u" id="nomor_u" value="{{ old('nomor_u', '') }}">
                @if($errors->has('nomor_u'))
                    <span class="text-danger">{{ $errors->first('nomor_u') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nomor_u_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.dataPerangkatKera.fields.keterangan') }}</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ip">{{ trans('cruds.dataPerangkatKera.fields.ip') }}</label>
                <input class="form-control {{ $errors->has('ip') ? 'is-invalid' : '' }}" type="text" name="ip" id="ip" value="{{ old('ip', '') }}">
                @if($errors->has('ip'))
                    <span class="text-danger">{{ $errors->first('ip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.ip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahun_berakhir_garansi">{{ trans('cruds.dataPerangkatKera.fields.tahun_berakhir_garansi') }}</label>
                <input class="form-control date {{ $errors->has('tahun_berakhir_garansi') ? 'is-invalid' : '' }}" type="text" name="tahun_berakhir_garansi" id="tahun_berakhir_garansi" value="{{ old('tahun_berakhir_garansi') }}">
                @if($errors->has('tahun_berakhir_garansi'))
                    <span class="text-danger">{{ $errors->first('tahun_berakhir_garansi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.tahun_berakhir_garansi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nomor_u_kosong">{{ trans('cruds.dataPerangkatKera.fields.nomor_u_kosong') }}</label>
                <input class="form-control {{ $errors->has('nomor_u_kosong') ? 'is-invalid' : '' }}" type="text" name="nomor_u_kosong" id="nomor_u_kosong" value="{{ old('nomor_u_kosong', '') }}">
                @if($errors->has('nomor_u_kosong'))
                    <span class="text-danger">{{ $errors->first('nomor_u_kosong') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nomor_u_kosong_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="foto">{{ trans('cruds.dataPerangkatKera.fields.foto') }}</label>
                <div class="needsclick dropzone {{ $errors->has('foto') ? 'is-invalid' : '' }}" id="foto-dropzone">
                </div>
                @if($errors->has('foto'))
                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.foto_helper') }}</span>
            </div>
            <b> Kontak PIC </b>
            <div class="form-group">
                <label for="kontak_pic">{{ trans('cruds.dataPerangkatKera.fields.kontak_pic') }}</label>
                <input class="form-control {{ $errors->has('kontak_pic') ? 'is-invalid' : '' }}" type="text" name="kontak_pic" id="kontak_pic" value="{{ old('kontak_pic', '') }}">
                @if($errors->has('kontak_pic'))
                    <span class="text-danger">{{ $errors->first('kontak_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.kontak_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_status_id">{{ trans('cruds.dataPerangkatKera.fields.nama_status') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_status') ? 'is-invalid' : '' }}" name="nama_status_id" id="nama_status_id">
                    @foreach($nama_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_status'))
                    <span class="text-danger">{{ $errors->first('nama_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nama_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_lokasi_id">{{ trans('cruds.dataPerangkatKera.fields.nama_lokasi') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_lokasi') ? 'is-invalid' : '' }}" name="nama_lokasi_id" id="nama_lokasi_id">
                    @foreach($nama_lokasis as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_lokasi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_lokasi'))
                    <span class="text-danger">{{ $errors->first('nama_lokasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.nama_lokasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ruang_panel">{{ trans('cruds.dataPerangkatKera.fields.ruang_panel') }}</label>
                <input class="form-control {{ $errors->has('ruang_panel') ? 'is-invalid' : '' }}" type="text" name="ruang_panel" id="ruang_panel" value="{{ old('ruang_panel', '') }}">
                @if($errors->has('ruang_panel'))
                    <span class="text-danger">{{ $errors->first('ruang_panel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dataPerangkatKera.fields.ruang_panel_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedFotoMap = {}
Dropzone.options.fotoDropzone = {
    url: '{{ route('admin.data-perangkat-keras.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="foto[]" value="' + response.name + '">')
      uploadedFotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFotoMap[file.name]
      }
      $('form').find('input[name="foto[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($dataPerangkatKera) && $dataPerangkatKera->foto)
      var files = {!! json_encode($dataPerangkatKera->foto) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="foto[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection