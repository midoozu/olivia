<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrAllowances;
use App\Http\Requests\HR\AllowancesRequest;

class AllowanceController extends Controller
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

            $all_data = HrAllowances::orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->addColumn('placeholder', '&nbsp;')

                ->addColumn('actions', function ($data) {

                        $html = "
                            <a style='float:right; margin:1px;' href='".route('admin.HRAllowances.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('admin.HRAllowances.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";


                    return $html;
                })
                ->rawColumns(['actions','title','value','placeholder'])->make(true);
        }

        return view('admin.HR.Allowances.grid')->with(['route_url'=>route('admin.HRAllowances.index'), 'page_title'=>'البدلات', 'show_actions'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $output = [
            'page_title'  => 'إضافة بدل',
            'form_action' => route('admin.HRAllowances.store')
        ];

        return view('admin.HR.Allowances.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AllowancesRequest $request)
    {
        //
        HRAllowances::create([
            'title' => $request->title,
            'value' => $request->value,

        ]);

        return redirect()->route('admin.HRAllowances.index')->with(['success' => 'تمت الإضافة بنجاح']);
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
        $row_data = HRAllowances::find($id);


        $output = [
            'row_data'    => $row_data,
            'page_title'  => 'تعديل بدل  *'.$row_data->title.'*',
            'form_action' => route('admin.HRAllowances.update',$row_data->id)
        ];

        return view('admin.HR.Allowances.form')->with($output);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllowancesRequest $request, $id)
    {
        //

        $job_data = HRAllowances::findOrFail($id);

        $job_data->update([
            'title' => $request->title,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.HRAllowances.index')->with(['success' => 'تم التحديث بنجاح']);
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
        $row_data = HRAllowances::findOrFail($id);

        $row_data->delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);

    }

    public function updateAllowanceValue(Request $request)
    {
        $status = 'fail';
        if($request->allowance_id != 0){
            $allowance_data = HRAllowances::find($request->allowance_id);

            if(isset($allowance_data)){
                $allowance_data->update(['value' => $request->value ]);

                $status = 'success';
            }
        }

        return response()->json(['status'=>$status]);


    }
}
