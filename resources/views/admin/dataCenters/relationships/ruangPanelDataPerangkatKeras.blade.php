<div class="m-3">
    @can('data_perangkat_kera_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.data-perangkat-keras.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.dataPerangkatKera.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.dataPerangkatKera.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-ruangPanelDataPerangkatKeras">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nomor_rak') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nama_merk') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nama_jenis') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.tipe') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.serial_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.tahun_beli') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nomor_u') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.jumlah') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.keterangan') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.ip') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.tahun_berakhir_garansi') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nomor_u_kosong') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.foto') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.kontak_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nama_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.nama_lokasi') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataPerangkatKera.fields.ruang_panel') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataCenter.fields.nama') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataPerangkatKeras as $key => $dataPerangkatKera)
                            <tr data-entry-id="{{ $dataPerangkatKera->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $dataPerangkatKera->id ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nomor_rak->nomor ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nama_merk->nama ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nama_jenis->nama ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->tipe ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->serial_number ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->tahun_beli ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nomor_u ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->jumlah ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->keterangan ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->ip ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->tahun_berakhir_garansi ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nomor_u_kosong ?? '' }}
                                </td>
                                <td>
                                    @foreach($dataPerangkatKera->foto as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->kontak_pic ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nama_status->nama ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->nama_lokasi->nama ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->ruang_panel->ruang_panel ?? '' }}
                                </td>
                                <td>
                                    {{ $dataPerangkatKera->ruang_panel->nama ?? '' }}
                                </td>
                                <td>
                                    @can('data_perangkat_kera_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.data-perangkat-keras.show', $dataPerangkatKera->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('data_perangkat_kera_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.data-perangkat-keras.edit', $dataPerangkatKera->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('data_perangkat_kera_delete')
                                        <form action="{{ route('admin.data-perangkat-keras.destroy', $dataPerangkatKera->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('data_perangkat_kera_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-perangkat-keras.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ruangPanelDataPerangkatKeras:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection