<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttRequest;
use App\Http\Requests\StoreAttRequest;
use App\Http\Requests\UpdateAttRequest;
use App\Models\Att;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('att_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atts = Att::all();

        return view('admin.atts.index', compact('atts'));
    }

    public function create()
    {
        abort_if(Gate::denies('att_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.atts.create');
    }

    public function store(StoreAttRequest $request)
    {
        $att = Att::create($request->all());

        return redirect()->route('admin.atts.index');
    }

    public function edit(Att $att)
    {
        abort_if(Gate::denies('att_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.atts.edit', compact('att'));
    }

    public function update(UpdateAttRequest $request, Att $att)
    {
        $att->update($request->all());

        return redirect()->route('admin.atts.index');
    }

    public function show(Att $att)
    {
        abort_if(Gate::denies('att_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $att->load('attProducts');

        return view('admin.atts.show', compact('att'));
    }

    public function destroy(Att $att)
    {
        abort_if(Gate::denies('att_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $att->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttRequest $request)
    {
        Att::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
