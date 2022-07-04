<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvoicesTypeRequest;
use App\Http\Requests\StoreInvoicesTypeRequest;
use App\Http\Requests\UpdateInvoicesTypeRequest;
use App\Models\InvoicesType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoicesTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('invoices_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InvoicesType::query()->select(sprintf('%s.*', (new InvoicesType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'invoices_type_show';
                $editGate      = 'invoices_type_edit';
                $deleteGate    = 'invoices_type_delete';
                $crudRoutePart = 'invoices-types';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('invoice_type', function ($row) {
                return $row->invoice_type ? $row->invoice_type : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.invoicesTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoices_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoicesTypes.create');
    }

    public function store(StoreInvoicesTypeRequest $request)
    {
        $invoicesType = InvoicesType::create($request->all());

        return redirect()->route('admin.invoices-types.index');
    }

    public function edit(InvoicesType $invoicesType)
    {
        abort_if(Gate::denies('invoices_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoicesTypes.edit', compact('invoicesType'));
    }

    public function update(UpdateInvoicesTypeRequest $request, InvoicesType $invoicesType)
    {
        $invoicesType->update($request->all());

        return redirect()->route('admin.invoices-types.index');
    }

    public function show(InvoicesType $invoicesType)
    {
        abort_if(Gate::denies('invoices_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoicesTypes.show', compact('invoicesType'));
    }

    public function destroy(InvoicesType $invoicesType)
    {
        abort_if(Gate::denies('invoices_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoicesType->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoicesTypeRequest $request)
    {
        InvoicesType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
