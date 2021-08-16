<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDataCenterRequest;
use App\Http\Requests\StoreDataCenterRequest;
use App\Http\Requests\UpdateDataCenterRequest;
use App\Models\DataCenter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataCenterController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('data_center_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataCenter::query()->select(sprintf('%s.*', (new DataCenter())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'data_center_show';
                $editGate = 'data_center_edit';
                $deleteGate = 'data_center_delete';
                $crudRoutePart = 'data-centers';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.dataCenters.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_center_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataCenters.create');
    }

    public function store(StoreDataCenterRequest $request)
    {
        $dataCenter = DataCenter::create($request->all());

        return redirect()->route('admin.data-centers.index');
    }

    public function edit(DataCenter $dataCenter)
    {
        abort_if(Gate::denies('data_center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataCenters.edit', compact('dataCenter'));
    }

    public function update(UpdateDataCenterRequest $request, DataCenter $dataCenter)
    {
        $dataCenter->update($request->all());

        return redirect()->route('admin.data-centers.index');
    }

    public function show(DataCenter $dataCenter)
    {
        abort_if(Gate::denies('data_center_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataCenters.show', compact('dataCenter'));
    }

    public function destroy(DataCenter $dataCenter)
    {
        abort_if(Gate::denies('data_center_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataCenter->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataCenterRequest $request)
    {
        DataCenter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
