<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRakRequest;
use App\Http\Requests\StoreRakRequest;
use App\Http\Requests\UpdateRakRequest;
use App\Models\Rak;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RakController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('rak_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Rak::query()->select(sprintf('%s.*', (new Rak())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rak_show';
                $editGate = 'rak_edit';
                $deleteGate = 'rak_delete';
                $crudRoutePart = 'raks';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nomor', function ($row) {
                return $row->nomor ? $row->nomor : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.raks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rak_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.raks.create');
    }

    public function store(StoreRakRequest $request)
    {
        $rak = Rak::create($request->all());

        return redirect()->route('admin.raks.index');
    }

    public function edit(Rak $rak)
    {
        abort_if(Gate::denies('rak_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.raks.edit', compact('rak'));
    }

    public function update(UpdateRakRequest $request, Rak $rak)
    {
        $rak->update($request->all());

        return redirect()->route('admin.raks.index');
    }

    public function show(Rak $rak)
    {
        abort_if(Gate::denies('rak_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.raks.show', compact('rak'));
    }

    public function destroy(Rak $rak)
    {
        abort_if(Gate::denies('rak_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rak->delete();

        return back();
    }

    public function massDestroy(MassDestroyRakRequest $request)
    {
        Rak::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
