<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAdaRequest;
use App\Http\Requests\StoreAdaRequest;
use App\Http\Requests\UpdateAdaRequest;
use App\Models\Ada;
use App\Models\Membership;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('ada_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adas = Ada::with(['member_name'])->get();

        $memberships = Membership::get();

        return view('admin.adas.index', compact('adas', 'memberships'));
    }

    public function create()
    {
        abort_if(Gate::denies('ada_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member_names = Membership::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.adas.create', compact('member_names'));
    }

    public function store(StoreAdaRequest $request)
    {
        $ada = Ada::create($request->all());

        return redirect()->route('admin.adas.index');
    }

    public function edit(Ada $ada)
    {
        abort_if(Gate::denies('ada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member_names = Membership::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ada->load('member_name');

        return view('admin.adas.edit', compact('ada', 'member_names'));
    }

    public function update(UpdateAdaRequest $request, Ada $ada)
    {
        $ada->update($request->all());

        return redirect()->route('admin.adas.index');
    }

    public function show(Ada $ada)
    {
        abort_if(Gate::denies('ada_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ada->load('member_name');

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
