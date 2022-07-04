<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySizeRequest;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SizeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sizes = Size::all();

        return view('frontend.sizes.index', compact('sizes'));
    }

    public function create()
    {
        abort_if(Gate::denies('size_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.sizes.create');
    }

    public function store(StoreSizeRequest $request)
    {
        $size = Size::create($request->all());

        return redirect()->route('frontend.sizes.index');
    }

    public function edit(Size $size)
    {
        abort_if(Gate::denies('size_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.sizes.edit', compact('size'));
    }

    public function update(UpdateSizeRequest $request, Size $size)
    {
        $size->update($request->all());

        return redirect()->route('frontend.sizes.index');
    }

    public function show(Size $size)
    {
        abort_if(Gate::denies('size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $size->load('sizeProducts');

        return view('frontend.sizes.show', compact('size'));
    }

    public function destroy(Size $size)
    {
        abort_if(Gate::denies('size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $size->delete();

        return back();
    }

    public function massDestroy(MassDestroySizeRequest $request)
    {
        Size::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
