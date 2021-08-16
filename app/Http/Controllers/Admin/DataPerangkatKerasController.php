<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataPerangkatKeraRequest;
use App\Http\Requests\StoreDataPerangkatKeraRequest;
use App\Http\Requests\UpdateDataPerangkatKeraRequest;
use App\Models\DataCenter;
use App\Models\DataPerangkatKera;
use App\Models\Jeni;
use App\Models\Merk;
use App\Models\Rak;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataPerangkatKerasController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('data_perangkat_kera_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataPerangkatKera::with(['nomor_rak', 'nama_merk', 'nama_jenis', 'nama_status', 'nama_lokasi'])->select(sprintf('%s.*', (new DataPerangkatKera())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'data_perangkat_kera_show';
                $editGate = 'data_perangkat_kera_edit';
                $deleteGate = 'data_perangkat_kera_delete';
                $crudRoutePart = 'data-perangkat-keras';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('nomor_rak_nomor', function ($row) {
                return $row->nomor_rak ? $row->nomor_rak->nomor : '';
            });

            $table->addColumn('nama_merk_nama', function ($row) {
                return $row->nama_merk ? $row->nama_merk->nama : '';
            });

            $table->addColumn('nama_jenis_nama', function ($row) {
                return $row->nama_jenis ? $row->nama_jenis->nama : '';
            });

            $table->addColumn('nama_status_nama', function ($row) {
                return $row->nama_status ? $row->nama_status->nama : '';
            });

            $table->addColumn('nama_lokasi_nama', function ($row) {
                return $row->nama_lokasi ? $row->nama_lokasi->nama : '';
            });

            $table->editColumn('ruang_panel', function ($row) {
                return $row->ruang_panel ? $row->ruang_panel : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nomor_rak', 'nama_merk', 'nama_jenis', 'nama_status', 'nama_lokasi']);

            return $table->make(true);
        }

        $raks         = Rak::get();
        $merks        = Merk::get();
        $jenis        = Jeni::get();
        $statuses     = Status::get();
        $data_centers = DataCenter::get();

        return view('admin.dataPerangkatKeras.index', compact('raks', 'merks', 'jenis', 'statuses', 'data_centers'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_perangkat_kera_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nomor_raks = Rak::pluck('nomor', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_merks = Merk::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_jenis = Jeni::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_statuses = Status::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_lokasis = DataCenter::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dataPerangkatKeras.create', compact('nomor_raks', 'nama_merks', 'nama_jenis', 'nama_statuses', 'nama_lokasis'));
    }

    public function store(StoreDataPerangkatKeraRequest $request)
    {
        $dataPerangkatKera = DataPerangkatKera::create($request->all());

        foreach ($request->input('foto', []) as $file) {
            $dataPerangkatKera->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataPerangkatKera->id]);
        }

        return redirect()->route('admin.data-perangkat-keras.index');
    }

    public function edit(DataPerangkatKera $dataPerangkatKera)
    {
        abort_if(Gate::denies('data_perangkat_kera_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nomor_raks = Rak::pluck('nomor', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_merks = Merk::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_jenis = Jeni::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_statuses = Status::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_lokasis = DataCenter::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dataPerangkatKera->load('nomor_rak', 'nama_merk', 'nama_jenis', 'nama_status', 'nama_lokasi');

        return view('admin.dataPerangkatKeras.edit', compact('nomor_raks', 'nama_merks', 'nama_jenis', 'nama_statuses', 'nama_lokasis', 'dataPerangkatKera'));
    }

    public function update(UpdateDataPerangkatKeraRequest $request, DataPerangkatKera $dataPerangkatKera)
    {
        $dataPerangkatKera->update($request->all());

        if (count($dataPerangkatKera->foto) > 0) {
            foreach ($dataPerangkatKera->foto as $media) {
                if (!in_array($media->file_name, $request->input('foto', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dataPerangkatKera->foto->pluck('file_name')->toArray();
        foreach ($request->input('foto', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataPerangkatKera->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto');
            }
        }

        return redirect()->route('admin.data-perangkat-keras.index');
    }

    public function show(DataPerangkatKera $dataPerangkatKera)
    {
        abort_if(Gate::denies('data_perangkat_kera_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataPerangkatKera->load('nomor_rak', 'nama_merk', 'nama_jenis', 'nama_status', 'nama_lokasi');

        return view('admin.dataPerangkatKeras.show', compact('dataPerangkatKera'));
    }

    public function destroy(DataPerangkatKera $dataPerangkatKera)
    {
        abort_if(Gate::denies('data_perangkat_kera_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataPerangkatKera->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataPerangkatKeraRequest $request)
    {
        DataPerangkatKera::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_perangkat_kera_create') && Gate::denies('data_perangkat_kera_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DataPerangkatKera();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
