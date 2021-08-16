<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataCenterRequest;
use App\Http\Requests\UpdateDataCenterRequest;
use App\Http\Resources\Admin\DataCenterResource;
use App\Models\DataCenter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataCenterApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('data_center_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataCenterResource(DataCenter::all());
    }

    public function store(StoreDataCenterRequest $request)
    {
        $dataCenter = DataCenter::create($request->all());

        return (new DataCenterResource($dataCenter))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataCenter $dataCenter)
    {
        abort_if(Gate::denies('data_center_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataCenterResource($dataCenter);
    }

    public function update(UpdateDataCenterRequest $request, DataCenter $dataCenter)
    {
        $dataCenter->update($request->all());

        return (new DataCenterResource($dataCenter))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataCenter $dataCenter)
    {
        abort_if(Gate::denies('data_center_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataCenter->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
