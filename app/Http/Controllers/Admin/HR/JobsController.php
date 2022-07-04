<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrJobs;
use App\Models\HR\HrDepartment;
use App\Http\Requests\HR\JobsRequest;

class JobsController extends Controller
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

            $all_data = HrJobs::with(['department'])->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->addColumn('placeholder', '&nbsp;')


                ->editColumn('title', function ($data) {
                    return $data->title;
                })
                ->editColumn('department', function ($data) {
                    return $data->department->title;
                })
                ->editColumn('max_salary', function ($data) {
                    return $data->max_salary ;
                })
                ->editColumn('min_salary', function ($data) {
                    return $data->min_salary ;
                })


                ->addColumn('actions', function ($data) {

                        $html = "
                            <a href='".route('admin.HRJobs.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('admin.HRJobs.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";


                    return $html;
                })
                ->rawColumns(['actions','title','department_id','max_salary','min_salary','placeholder'])->make(true);
        }

        return view('admin.HR.Jobs.jobsGrid')->with(['route_url'=>route('admin.HRJobs.index'), 'page_title'=>'إعدادات الوظائف', 'show_actions'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $departments = HrDepartment::get();


        $output = [
            'departments' => $departments,
            'page_title'  => 'إضافة وظيفة',
            'form_action' => route('admin.HRJobs.store')
        ];

        return view('admin.HR.Jobs.jobs_form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobsRequest $request)
    {
        //
        $data = HrJobs::create([
            'title'         => $request->title,
            'max_salary'    => $request->max_salary,
            'min_salary'    => $request->min_salary,
            'department_id' => $request->department_id,
        ]);



        return redirect()->route('admin.HRJobs.index')->with(['success' => 'تمت الإضافة بنجاح']);
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
        //
        $row_data = HrJobs::find($id);
        $departments = HrDepartment::get();


        $output = [
            'row_data'    => $row_data,
            'departments' => $departments,
            'page_title'  => 'تعديل وظيفة  *'.$row_data->title.'*',
            'form_action' => route('admin.HRJobs.update',$row_data->id)
        ];

        return view('admin.HR.Jobs.jobs_form')->with($output);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobsRequest $request, $id)
    {
        //

        $job_data = HrJobs::findOrFail($id);

        $job_data->update([
            'title'         => $request->title,
            'max_salary'    => $request->max_salary,
            'min_salary'    => $request->min_salary,
            'department_id' => $request->department_id,
        ]);



        return redirect()->route('admin.HRJobs.index')->with(['success' => 'تم التحديث بنجاح']);
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
        $row_data = HrJobs::findOrFail($id);

        $row_data->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);

    }
}
