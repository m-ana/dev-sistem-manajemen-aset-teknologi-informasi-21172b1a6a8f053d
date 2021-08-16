<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJeniRequest;
use App\Http\Requests\StoreJeniRequest;
use App\Http\Requests\UpdateJeniRequest;
use App\Models\Jeni;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JenisController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('jeni_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Jeni::query()->select(sprintf('%s.*', (new Jeni())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'jeni_show';
                $editGate = 'jeni_edit';
                $deleteGate = 'jeni_delete';
                $crudRoutePart = 'jenis';

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

        return view('admin.jenis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('jeni_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenis.create');
    }

    public function store(StoreJeniRequest $request)
    {
        $jeni = Jeni::create($request->all());

        return redirect()->route('admin.jenis.index');
    }

    public function edit(Jeni $jeni)
    {
        abort_if(Gate::denies('jeni_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenis.edit', compact('jeni'));
    }

    public function update(UpdateJeniRequest $request, Jeni $jeni)
    {
        $jeni->update($request->all());

        return redirect()->route('admin.jenis.index');
    }

    public function show(Jeni $jeni)
    {
        abort_if(Gate::denies('jeni_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenis.show', compact('jeni'));
    }

    public function destroy(Jeni $jeni)
    {
        abort_if(Gate::denies('jeni_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jeni->delete();

        return back();
    }

    public function massDestroy(MassDestroyJeniRequest $request)
    {
        Jeni::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
