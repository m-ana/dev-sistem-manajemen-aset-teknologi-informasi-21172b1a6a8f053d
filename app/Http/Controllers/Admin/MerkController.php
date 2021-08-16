<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMerkRequest;
use App\Http\Requests\StoreMerkRequest;
use App\Http\Requests\UpdateMerkRequest;
use App\Models\Merk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MerkController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('merk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Merk::query()->select(sprintf('%s.*', (new Merk())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'merk_show';
                $editGate = 'merk_edit';
                $deleteGate = 'merk_delete';
                $crudRoutePart = 'merks';

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

        return view('admin.merks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('merk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merks.create');
    }

    public function store(StoreMerkRequest $request)
    {
        $merk = Merk::create($request->all());

        return redirect()->route('admin.merks.index');
    }

    public function edit(Merk $merk)
    {
        abort_if(Gate::denies('merk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merks.edit', compact('merk'));
    }

    public function update(UpdateMerkRequest $request, Merk $merk)
    {
        $merk->update($request->all());

        return redirect()->route('admin.merks.index');
    }

    public function show(Merk $merk)
    {
        abort_if(Gate::denies('merk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merks.show', compact('merk'));
    }

    public function destroy(Merk $merk)
    {
        abort_if(Gate::denies('merk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merk->delete();

        return back();
    }

    public function massDestroy(MassDestroyMerkRequest $request)
    {
        Merk::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
