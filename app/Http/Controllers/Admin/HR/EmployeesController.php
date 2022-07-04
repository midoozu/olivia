<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrEmployee;
use App\Models\HR\HrDepartment;
use App\Models\HR\HrJobs;
use App\Models\HR\HrAllowances;
use App\Models\HR\HrEmployeeAllowances;
use App\Http\Requests\HR\EmployeesRequest;
use App\Http\Traits\Upload_Files;
use Illuminate\Support\Facades\Storage;


class EmployeesController extends Controller
{
    use Upload_Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $all_data = HrEmployee::with('department')->orderby('id','DESC')->get();

        //return all data
        if ($request->ajax()) {

            $all_data = HrEmployee::with('department')->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->addColumn('placeholder', '&nbsp;')


                ->editColumn('department_id', function ($data){
                    return $data->department->title ?? '';
                })

                ->addColumn('actions', function ($data) {


                        $html = "
                            <a style='float:right; margin:1px;' href='".route('admin.HREmployee.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('admin.HREmployee.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";


                    return $html;
                })
                ->rawColumns(['actions','title','value','placeholder'])->make(true);
        }

        return view('admin.HR.Employees.grid')->with(['route_url'=>route('admin.HREmployee.index'), 'page_title'=>'الموظفين']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $departments = HrDepartment::get();
        $jobs        = HrJobs::get();
        $allowances  = HrAllowances::get();


        $new_allowances = $allowances->mapWithKeys(function ($item) {
            return [$item['id'] => $item];
        });

        $output = [
            'page_title'  => 'إضافة موظف',
            'departments' => $departments,
            'jobs'        => $jobs,
            'allowances'  => $new_allowances,
            'form_action' => route('admin.HREmployee.store')
        ];

        return view('admin.HR.Employees.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {

        //check salary
        $job_data = HrJobs::findOrFail($request->job_id);
        if($request->salary > $job_data->max_salary || $request->salary < $job_data->min_salary)
        {
            //validation error
             return redirect()->back()->withInput()->withErrors(['salary' => 'قيمة الراتب خارج رينج الوظيفة']);
        }
        else
        {
            $image = '';
            $cv    = '';

            if ($request->image != ''){
                $image = $this->uploadFiles("HrEmployees",$request->file("image"),null);
            }

            if ($request->cv != ''){
                $cv = $this->uploadFiles("HrEmployees",$request->file("cv"),null);
            }

            $new_emp = HrEmployee::create([
                'name'           => $request->name,
                'phone'          => $request->phone,
                'other_phone'    => $request->other_phone,
                'email'          => $request->email,
                'department_id'  => $request->department_id,
                'job_id'         => $request->job_id,
                'salary'         => $request->salary,
                'commission_per' => $request->commission_per,
                'insurances_per' => $request->insurances_per,
                'tax_per'        => $request->tax_per,
                'address'        => $request->address,
                'image'          => $image,
                'cv'             => $cv,
            ]);

            //emp allowances data
            $allowances = $request->allowance;
            $allowances_vals = $request->allowance_val;

            if(empty($allowances_vals))
            {
                foreach($allowances_vals as $key=>$val)
                {
                    HrEmployeeAllowances::create([
                        'employee_id'  => $new_emp->id,
                        'allowance_id' => $allowances[$key],
                        'value'        => $val,
                    ]);
                }
            }


            return redirect()->route('admin.HREmployee.index')->with(['success' => 'تمت الإضافة بنجاح']);
        }
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
        $emp_data    = HrEmployee::with(['allowances'])->findOrFail($id);

        $departments = HrDepartment::get();
        $jobs        = HrJobs::get();
        $allowances  = HrAllowances::get();

        //return $emp_data;
        //$allowances =

        $new_allowances = $allowances->mapWithKeys(function ($item) {
            return [$item['id'] => $item];
        });

        $output = [
            'page_title'  => 'تعديل موظف',
            'departments' => $departments,
            'jobs'        => $jobs,
            'allowances'  => $new_allowances,
            'row_data'    => $emp_data,
            'form_action' => route('admin.HREmployee.update', $emp_data->id)
        ];

        return view('admin.HR.Employees.form')->with($output);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesRequest $request, $id)
    {
        //return $request;
        //check salary
        $job_data = HrJobs::findOrFail($request->job_id);
        if($request->salary > $job_data->max_salary || $request->salary < $job_data->min_salary)
        {
            //validation error
             return redirect()->back()->withInput()->withErrors(['salary' => 'قيمة الراتب خارج رينج الوظيفة']);
        }
        else
        {
            $emp_data = HrEmployee::findOrFail($id);
            $image = $emp_data->image;
            $cv    = $emp_data->cv;

            if ($request->image != ''){
                $image = $this->uploadFiles("HrEmployees",$request->file("image"),null);
            }

            if ($request->cv != ''){
                $cv = $this->uploadFiles("HrEmployees",$request->file("cv"),null);
            }

            $emp_data->update([
                'name'           => $request->name,
                'phone'          => $request->phone,
                'other_phone'    => $request->other_phone,
                'email'          => $request->email,
                'department_id'  => $request->department_id,
                'job_id'         => $request->job_id,
                'salary'         => $request->salary,
                'commission_per' => $request->commission_per,
                'insurances_per' => $request->insurances_per,
                'tax_per'        => $request->tax_per,
                'address'        => $request->address,
                'image'          => $image,
                'cv'             => $cv,
            ]);

            //delete emp old allowances
            HrEmployeeAllowances::where('employee_id', $id )->delete();
            //emp allowances data
            $allowances      = $request->allowances;
            $allowances_vals = $request->allowance_val;

            if(! is_null($allowances_vals) )
            {
                foreach($allowances_vals as $key=>$val)
                {
                    if(empty($allowances[$key]) && $allowances[$key] != 0)
                    {
                        HrEmployeeAllowances::create([
                            'employee_id'  => $id,
                            'allowance_id' => $allowances[$key],
                            'value'        => $val,
                        ]);
                    }
                }
            }



            toastr()->success("تم تعديل بيانات الموظف  بنجاح");
            return redirect()->route('admin.HREmployee.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $row_data = HrEmployee::findOrFail($id);

        $row_data->delete();
        return redirect()->route('admin.HREmployee.index')->with(['success'=>'تم الحذف بنجاح']);
    }

}
