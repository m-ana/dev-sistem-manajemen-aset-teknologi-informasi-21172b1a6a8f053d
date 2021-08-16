@extends('layouts.admin')
@section('content')
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
            {{ trans('global.list') }} {{ trans('cruds.dataPerangkatKera.title_singular') }} 
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DataPerangkatKera">
            <thead>
                <tr>
                    <th width="10">

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
                        {{ trans('cruds.dataPerangkatKera.fields.tahun_berakhir_garansi') }}
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
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($raks as $key => $item)
                                <option value="{{ $item->nomor }}">{{ $item->nomor }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($merks as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($jenis as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($statuses as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($data_centers as $key => $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('data_perangkat_kera_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-perangkat-keras.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.data-perangkat-keras.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nomor_rak_nomor', name: 'nomor_rak.nomor' },
{ data: 'nama_merk_nama', name: 'nama_merk.nama' },
{ data: 'nama_jenis_nama', name: 'nama_jenis.nama' },
{ data: 'tahun_berakhir_garansi', name: 'tahun_berakhir_garansi' },
{ data: 'nama_status_nama', name: 'nama_status.nama' },
{ data: 'nama_lokasi_nama', name: 'nama_lokasi.nama' },
{ data: 'ruang_panel', name: 'ruang_panel' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-DataPerangkatKera').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection