<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMembershipRequest;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Membership;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MembershipController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('membership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Membership::query()->select(sprintf('%s.*', (new Membership())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'membership_show';
                $editGate = 'membership_edit';
                $deleteGate = 'membership_delete';
                $crudRoutePart = 'memberships';

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
            $table->editColumn('member_status', function ($row) {
                return $row->member_status ? $row->member_status : '';
            });
            $table->editColumn('member_reference', function ($row) {
                return $row->member_reference ? $row->member_reference : '';
            });
            $table->editColumn('member_class', function ($row) {
                return $row->member_class ? $row->member_class : '';
            });
            $table->editColumn('member_name', function ($row) {
                return $row->member_name ? $row->member_name : '';
            });
            $table->editColumn('member_email', function ($row) {
                return $row->member_email ? $row->member_email : '';
            });

            $table->editColumn('awarding_body', function ($row) {
                return $row->awarding_body ? $row->awarding_body : '';
            });
            $table->editColumn('training_credits', function ($row) {
                return $row->training_credits;
            });
            $table->editColumn('support_funds', function ($row) {
                return $row->support_funds;
            });
            $table->editColumn('digital_member_card', function ($row) {
                return $row->digital_member_card ? $row->digital_member_card : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note;
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.memberships.index');
    }

    public function create()
    {
        abort_if(Gate::denies('membership_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memberships.create');
    }

    public function store(StoreMembershipRequest $request)
    {
        $membership = Membership::create($request->all());

        return redirect()->route('admin.memberships.index');
    }

    public function edit(Membership $membership)
    {
        abort_if(Gate::denies('membership_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memberships.edit', compact('membership'));
    }

    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership->update($request->all());

        return redirect()->route('admin.memberships.index');
    }

    public function show(Membership $membership)
    {
        abort_if(Gate::denies('membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memberships.show', compact('membership'));
    }

    public function destroy(Membership $membership)
    {
        abort_if(Gate::denies('membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membership->delete();

        return back();
    }

    public function massDestroy(MassDestroyMembershipRequest $request)
    {
        Membership::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
