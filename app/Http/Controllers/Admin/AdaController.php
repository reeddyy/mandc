<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAdaRequest;
use App\Http\Requests\StoreAdaRequest;
use App\Http\Requests\UpdateAdaRequest;
use App\Models\Ada;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AdaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ada_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ada::query()->select(sprintf('%s.*', (new Ada())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ada_show';
                $editGate = 'ada_edit';
                $deleteGate = 'ada_delete';
                $crudRoutePart = 'adas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('member_reference', function ($row) {
                return $row->member_reference ? $row->member_reference : '';
            });
            $table->editColumn('member_name', function ($row) {
                return $row->member_name ? $row->member_name : '';
            });
            $table->editColumn('award_name', function ($row) {
                return $row->award_name ? $row->award_name : '';
            });

            $table->editColumn('awarding_body', function ($row) {
                return $row->awarding_body ? $row->awarding_body : '';
            });
            $table->editColumn('award_reference', function ($row) {
                return $row->award_reference ? $row->award_reference : '';
            });
            $table->editColumn('award_status', function ($row) {
                return $row->award_status ? $row->award_status : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.adas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ada_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adas.create');
    }

    public function store(StoreAdaRequest $request)
    {
        $ada = Ada::create($request->all());

        return redirect()->route('admin.adas.index');
    }

    public function edit(Ada $ada)
    {
        abort_if(Gate::denies('ada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adas.edit', compact('ada'));
    }

    public function update(UpdateAdaRequest $request, Ada $ada)
    {
        $ada->update($request->all());

        return redirect()->route('admin.adas.index');
    }

    public function show(Ada $ada)
    {
        abort_if(Gate::denies('ada_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adas.show', compact('ada'));
    }

    public function destroy(Ada $ada)
    {
        abort_if(Gate::denies('ada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ada->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdaRequest $request)
    {
        Ada::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
