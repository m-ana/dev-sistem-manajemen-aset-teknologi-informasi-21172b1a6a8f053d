<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDataPerangkatKeraRequest;
use App\Http\Requests\UpdateDataPerangkatKeraRequest;
use App\Http\Resources\Admin\DataPerangkatKeraResource;
use App\Models\DataPerangkatKera;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataPerangkatKerasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_perangkat_kera_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataPerangkatKeraResource(DataPerangkatKera::with(['nomor_rak', 'nama_merk', 'nama_jenis', 'nama_status', 'nama_lokasi'])->get());
    }

    public function store(StoreDataPerangkatKeraRequest $request)
    {
        $dataPerangkatKera = DataPerangkatKera::create($request->all());

        if ($request->input('foto', false)) {
            $dataPerangkatKera->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        return (new DataPerangkatKeraResource($dataPerangkatKera))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataPerangkatKera $dataPerangkatKera)
    {
        abort_if(Gate::denies('data_perangkat_kera_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataPerangkatKeraResource($dataPerangkatKera->load(['nomor_rak', 'nama_merk', 'nama_jenis', 'nama_status', 'nama_lokasi']));
    }

    public function update(UpdateDataPerangkatKeraRequest $request, DataPerangkatKera $dataPerangkatKera)
    {
        $dataPerangkatKera->update($request->all());

        if ($request->input('foto', false)) {
            if (!$dataPerangkatKera->foto || $request->input('foto') !== $dataPerangkatKera->foto->file_name) {
                if ($dataPerangkatKera->foto) {
                    $dataPerangkatKera->foto->delete();
                }
                $dataPerangkatKera->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
            }
        } elseif ($dataPerangkatKera->foto) {
            $dataPerangkatKera->foto->delete();
        }

        return (new DataPerangkatKeraResource($dataPerangkatKera))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataPerangkatKera $dataPerangkatKera)
    {
        abort_if(Gate::denies('data_perangkat_kera_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataPerangkatKera->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
