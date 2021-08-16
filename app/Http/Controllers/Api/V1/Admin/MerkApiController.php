<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMerkRequest;
use App\Http\Requests\UpdateMerkRequest;
use App\Http\Resources\Admin\MerkResource;
use App\Models\Merk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerkApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('merk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MerkResource(Merk::all());
    }

    public function store(StoreMerkRequest $request)
    {
        $merk = Merk::create($request->all());

        return (new MerkResource($merk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Merk $merk)
    {
        abort_if(Gate::denies('merk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MerkResource($merk);
    }

    public function update(UpdateMerkRequest $request, Merk $merk)
    {
        $merk->update($request->all());

        return (new MerkResource($merk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Merk $merk)
    {
        abort_if(Gate::denies('merk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
