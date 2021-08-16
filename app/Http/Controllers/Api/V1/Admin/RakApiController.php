<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRakRequest;
use App\Http\Requests\UpdateRakRequest;
use App\Http\Resources\Admin\RakResource;
use App\Models\Rak;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RakApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rak_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RakResource(Rak::all());
    }

    public function store(StoreRakRequest $request)
    {
        $rak = Rak::create($request->all());

        return (new RakResource($rak))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rak $rak)
    {
        abort_if(Gate::denies('rak_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RakResource($rak);
    }

    public function update(UpdateRakRequest $request, Rak $rak)
    {
        $rak->update($request->all());

        return (new RakResource($rak))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rak $rak)
    {
        abort_if(Gate::denies('rak_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rak->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
