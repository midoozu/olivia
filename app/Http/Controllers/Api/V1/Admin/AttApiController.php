<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttRequest;
use App\Http\Requests\UpdateAttRequest;
use App\Http\Resources\Admin\AttResource;
use App\Models\Att;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('att_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttResource(Att::all());
    }

    public function store(StoreAttRequest $request)
    {
        $att = Att::create($request->all());

        return (new AttResource($att))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Att $att)
    {
        abort_if(Gate::denies('att_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttResource($att);
    }

    public function update(UpdateAttRequest $request, Att $att)
    {
        $att->update($request->all());

        return (new AttResource($att))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Att $att)
    {
        abort_if(Gate::denies('att_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $att->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
