<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrEmployeeSalaryAdvance;
use App\Models\HR\HrEmployee;
use App\Http\Requests\HR\AdvancesRequest;
use App\Models\HR\HrEmployeeSalaryAdvanceInstallment;

class EmployeeSalaryAdvance extends Controller
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

            $all_data = HrEmployeeSalaryAdvance::with('employee')->where(['pay_status'=>'new', 'type'=>'by_month'])->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->editColumn('employee_id', function($data){
                    return $data->employee->name;
                })
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', function ($data) {
                    $html = '';
                    if($data->pay_status == 'new')
                    {
                        $html = "
                            <a style='float:right; margin:1px;' href='".route('admin.HREmployeeAdvances.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('admin.HREmployeeAdvances.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";
                    }

                    return $html;
                })
                ->rawColumns(['actions','title','value','placeholder'])->make(true);
        }

        return view('admin.HR.Advances.grid')->with(['route_url'=>route('admin.HREmployeeAdvances.index'), 'page_title'=>'السلف']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $employees = HrEmployee::get();



        $output = [
            'page_title'  => 'إضافة سلفة',
            'employees'   => $employees,
            'form_action' => route('admin.HREmployeeAdvances.store')
        ];

        return view('admin.HR.Advances.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvancesRequest $request)
    {
        $date = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        $new_data = HrEmployeeSalaryAdvance::create([
                'employee_id'       => $request->employee_id,
                'value'             => $request->value,
                'one_month_amount'  => $request->one_month_amount,
                'type'              => 'by_month',//$request->type,
                'month'             => $month,
                'year'              => $year,
                'date'              => $request->date,
            ]);

        //add installments

        $monthes_count = ceil($request->value / $request->one_month_amount);

        $date  = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        for($i=1;$i<=$monthes_count;$i++)
        {
            $amount = $request->one_month_amount;


            //last month amount
            if($i == $monthes_count)
            {
                $amount = abs($request->value - ($request->one_month_amount * ($monthes_count-1)) );
            }

            $month_installment = HrEmployeeSalaryAdvanceInstallment::create([
                'employee_id'       => $request->employee_id,
                'salary_advance_id' => $new_data->id,
                'value'             => $amount,
                'date'              => $request->date,
                'month'             => $month,
                'year'              => $year ,
                'type'              => 'by_month',

            ]);

            if($month == 12)
            {
                $month = 0;
                $year++;
            }

            $month++;

        }



        toastr()->success("تم إضافة سلفة  بنجاح");
        return redirect()->route('admin.HREmployeeAdvances.index');

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
        $row_data = HrEmployeeSalaryAdvance::findOrFail($id);

        if($row_data->month <10)
        {
            $row_data->{'month'} = "0".$row_data->month;
        }

        $employees = HrEmployee::get();


        $output = [
            'page_title'  => 'تعديل سلفة',
            'employees'   => $employees,
            'row_data'    => $row_data,
            'form_action' => route('admin.HREmployeeAdvances.update', $id)
        ];

        return view('admin.HR.Advances.form')->with($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvancesRequest $request, $id)
    {
        $row_data = HrEmployeeSalaryAdvance::findOrFail($id);

        $date  = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];


        $row_data->update([
                'employee_id'       => $request->employee_id,
                'value'             => $request->value,
                'one_month_amount'  => $request->one_month_amount,
                'type'              => 'by_month',//$request->type,
                'date'              => $request->date,
                'month'             => $month,
                'year'              => $year,
            ]);


        //delete old installments
        HrEmployeeSalaryAdvanceInstallment::where('salary_advance_id', $id)->delete();

        //add installments
        $monthes_count = ceil($request->value / $request->one_month_amount);

        $date  = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        for($i=1;$i<=$monthes_count;$i++)
        {
            $amount = $request->one_month_amount;


            //last month amount
            if($i == $monthes_count)
            {
                $amount = abs($request->value - ($request->one_month_amount * ($monthes_count-1)) );
            }

            $month_installment = HrEmployeeSalaryAdvanceInstallment::create([
                'employee_id'       => $request->employee_id,
                'salary_advance_id' => $id,
                'value'             => $amount,
                'date'              => $request->date,
                'month'             => $month,
                'year'              => $year ,
                'type'              => 'by_month',

            ]);

            if($month == 12)
            {
                $month = 0;
                $year++;
            }
            $month++;

        }



        toastr()->success("تم تعديل سلفة  بنجاح");
        return redirect()->route('admin.HREmployeeAdvances.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row_data = HrEmployeeSalaryAdvance::findOrFail($id);

        $row_data->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }
}
