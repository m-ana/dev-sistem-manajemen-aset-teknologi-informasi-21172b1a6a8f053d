@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rak.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.raks.update", [$rak->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nomor">{{ trans('cruds.rak.fields.nomor') }}</label>
                <input class="form-control {{ $errors->has('nomor') ? 'is-invalid' : '' }}" type="text" name="nomor" id="nomor" value="{{ old('nomor', $rak->nomor) }}" required>
                @if($errors->has('nomor'))
                    <span class="text-danger">{{ $errors->first('nomor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rak.fields.nomor_helper') }}</span>
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