<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDriverDataRequest;
use App\Http\Requests\StoreDriverDataRequest;
use App\Http\Requests\UpdateDriverDataRequest;
use App\Models\DriverData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DriverDataController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('driver_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DriverData::query()->select(sprintf('%s.*', (new DriverData)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'driver_data_show';
                $editGate      = 'driver_data_edit';
                $deleteGate    = 'driver_data_delete';
                $crudRoutePart = 'driver-datas';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('driver_no', function ($row) {
                return $row->driver_no ? $row->driver_no : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.driverDatas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('driver_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.driverDatas.create');
    }

    public function store(StoreDriverDataRequest $request)
    {
        $driverData = DriverData::create($request->all());

        return redirect()->route('admin.driver-datas.index');
    }

    public function edit(DriverData $driverData)
    {
        abort_if(Gate::denies('driver_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.driverDatas.edit', compact('driverData'));
    }

    public function update(UpdateDriverDataRequest $request, DriverData $driverData)
    {
        $driverData->update($request->all());

        return redirect()->route('admin.driver-datas.index');
    }

    public function show(DriverData $driverData)
    {
        abort_if(Gate::denies('driver_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverData->load('driverNameReceiptdeliveries');

        return view('admin.driverDatas.show', compact('driverData'));
    }

    public function destroy(DriverData $driverData)
    {
        abort_if(Gate::denies('driver_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverData->delete();

        return back();
    }

    public function massDestroy(MassDestroyDriverDataRequest $request)
    {
        DriverData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
