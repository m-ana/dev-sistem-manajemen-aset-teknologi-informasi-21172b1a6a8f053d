<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJeniRequest;
use App\Http\Requests\UpdateJeniRequest;
use App\Http\Resources\Admin\JeniResource;
use App\Models\Jeni;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jeni_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JeniResource(Jeni::all());
    }

    public function store(StoreJeniRequest $request)
    {
        $jeni = Jeni::create($request->all());

        return (new JeniResource($jeni))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Jeni $jeni)
    {
        abort_if(Gate::denies('jeni_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JeniResource($jeni);
    }

    public function update(UpdateJeniRequest $request, Jeni $jeni)
    {
        $jeni->update($request->all());

        return (new JeniResource($jeni))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Jeni $jeni)
    {
        abort_if(Gate::denies('jeni_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jeni->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
