<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdaRequest;
use App\Http\Requests\UpdateAdaRequest;
use App\Http\Resources\Admin\AdaResource;
use App\Models\Ada;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ada_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdaResource(Ada::all());
    }

    public function store(StoreAdaRequest $request)
    {
        $ada = Ada::create($request->all());

        return (new AdaResource($ada))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ada $ada)
    {
        abort_if(Gate::denies('ada_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdaResource($ada);
    }

    public function update(UpdateAdaRequest $request, Ada $ada)
    {
        $ada->update($request->all());

        return (new AdaResource($ada))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ada $ada)
    {
        abort_if(Gate::denies('ada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ada->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
