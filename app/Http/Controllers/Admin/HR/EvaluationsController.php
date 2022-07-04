<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrEvaluation;
use App\Models\HR\HrJobs;
use App\Http\Requests\HR\EvaluationsRequest;


class EvaluationsController extends Controller
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

            $all_data = HrEvaluation::with(['jobs'])->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->editColumn('job_id', function ($data) {
                    return $data->jobs->title;
                })
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', function ($data) {

                        $html = "
                            <a style='float:right; margin:1px;' href='".route('admin.HREmployeeEvaluations.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('admin.HREmployeeEvaluations.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";


                    return $html;
                })
                ->rawColumns(['actions','job_id','placeholder'])->make(true);
        }

        return view('admin.HR.Evaluations.grid')->with(['route_url'=>route('admin.HREmployeeEvaluations.index'), 'page_title'=>'التقييمات']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $jobs   = HrJobs::get();

        $output = [
            'page_title'  => 'إضافة تقييم',
            'jobs'        => $jobs,
            'form_action' => route('admin.HREmployeeEvaluations.store')
        ];

        return view('admin.HR.Evaluations.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EvaluationsRequest $request)
    {
        $data = HrEvaluation::create([
            'title'   => $request->title,
            'details' => $request->details,
            'job_id'  => $request->job_id
        ]);



        return redirect()->route('admin.HREmployeeEvaluations.index')->with(['success' => 'تمت الإضافة بنجاح']);
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
        $row_data = HrEvaluation::findOrFail($id);

        $jobs   = HrJobs::get();

        $output = [
            'page_title'  => 'تعديل تقييم',
            'jobs'        => $jobs,
            'row_data'    => $row_data,
            'form_action' => route('admin.HREmployeeEvaluations.update', $id)
        ];

        return view('admin.HR.Evaluations.form')->with($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EvaluationsRequest $request, $id)
    {
        $row_data = HrEvaluation::findOrFail($id);

        $row_data->update([
            'title'   => $request->title,
            'details' => $request->details,
            'job_id'  => $request->job_id
        ]);



        return redirect()->route('admin.HREmployeeEvaluations.index')->with(['success' => 'تم تعديل التقييم بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row_data = HrEvaluation::findOrFail($id);

        $row_data->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }
}
