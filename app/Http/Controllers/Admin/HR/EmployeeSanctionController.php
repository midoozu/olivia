<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrEmployee;
use App\Models\HR\HrSonction;
use App\Models\HR\HrEmployeeSonction;
use App\Http\Requests\HR\EmployeeSanctionRequest;

class EmployeeSanctionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        //return all data
        if ($request->ajax()) {

            $all_data = HrEmployeeSonction::with(['employee', 'sanction'])->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->editColumn('employee_id', function ($data) {
                    return $data->employee->name;
                })
                ->editColumn('sonction_id', function ($data) {
                    return $data->sanction->title;
                })
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', function ($data) {

                        $html = "
                            <a style='float:right; margin:1px;' href='".route('admin.HREmployeeSanctions.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('admin.HREmployeeSanctions.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";

                    return $html;
                })
                ->rawColumns(['actions','placeholder','sonction_id','employee_id'])->make(true);
        }

        return view('admin.HR.EmployeesSanctions.grid')->with(['route_url'=>route('admin.HREmployeeSanctions.index'), 'page_title'=>'جزاءات الموظفين']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $employees   = HrEmployee::get();
        $sanctions   = HrSonction::get();


        $output = [
            'page_title'  => 'إضافة جزاء موظف',
            'employees'   => $employees,
            'sanctions'   => $sanctions,
            'form_action' => route('admin.HREmployeeSanctions.store')
        ];

        return view('admin.HR.EmployeesSanctions.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeSanctionRequest $request)
    {
        $date = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        $new_san = HrEmployeeSonction::create([
                'sonction_id' => $request->sonction_id,
                'employee_id' => $request->employee_id,
                'value'       => $request->value,
                'month'       => $month,
                'year'        => $year,
            ]);



         toastr()->success("تم إضافة جزاء موظف بنجاح");
         return redirect()->route('admin.HREmployeeSanctions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $row_data  = HrEmployeeSonction::findOrFail($id);
        $employees = HrEmployee::get();
        $sanctions = HrSonction::get();

        if($row_data->month <10)
        {
            $row_data->{'month'} = "0".$row_data->month;
        }

        //return $row_data;
        $output = [
            'page_title'  => 'تعديل إجازةموظف',
            'employees'   => $employees,
            'sanctions'   => $sanctions,
            'row_data'    => $row_data,
            'form_action' => route('admin.HREmployeeSanctions.update', $id)
        ];

        return view('admin.HR.EmployeesSanctions.form')->with($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeSanctionRequest $request, $id)
    {
        $san_data = HrEmployeeSonction::findOrFail($id);
        $date = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        $san_data->update([
                'sonction_id' => $request->sonction_id,
                'employee_id' => $request->employee_id,
                'value'       => $request->value,
                'month'       => $month,
                'year'        => $year,
            ]);



         toastr()->success("تم تعديل جزاء موظف بنجاح");
         return redirect()->route('admin.HREmployeeSanctions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row_data = HrEmployeeSonction::findOrFail($id);
        $row_data->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }
}
