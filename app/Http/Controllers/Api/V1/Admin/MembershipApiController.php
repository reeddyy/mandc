<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Http\Resources\Admin\MembershipResource;
use App\Models\Membership;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MembershipApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('membership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MembershipResource(Membership::all());
    }

    public function store(StoreMembershipRequest $request)
    {
        $membership = Membership::create($request->all());

        return (new MembershipResource($membership))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Membership $membership)
    {
        abort_if(Gate::denies('membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MembershipResource($membership);
    }

    public function getMembershipDetails($member_reference)
    {
        if ($member_reference) {
            $membership = Membership::with('adas')->where('member_reference', $member_reference)->first();
            if (!empty($membership)) {
                return (new MembershipResource($membership))
                    ->response()
                    ->setStatusCode(Response::HTTP_OK);
            } else {
                $data = array([
                    "message" => "No data found!"
                ]);
                return (new MembershipResource($data))
                    ->response()
                    ->setStatusCode(Response::HTTP_NOT_FOUND);
            }
        } else {
            $data = array([
                "message" => "Invalid member reference. Please enter a valid number!"
            ]);
            return (new MembershipResource($data))
                ->response()
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership->update($request->all());

        return (new MembershipResource($membership))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Membership $membership)
    {
        abort_if(Gate::denies('membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membership->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
