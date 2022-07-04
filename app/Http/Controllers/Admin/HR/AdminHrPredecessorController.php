<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\HrEmployee;
use App\Models\HR\HrEmployeeSalaryAdvance;
use App\Models\HR\HrEmployeeSalaryAdvanceInstallment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminHrPredecessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->add_log_activity(null,auth()->user(),"عرض سلف الموظفين");

        $datas = HrEmployeeSalaryAdvance::wherein('type',['regular','unregular'])->with('employee_rl')
            ->orderby("id","DESC")->get();


        if ($request->ajax()){
            return DataTables::of($datas)


                ->addColumn('employee', function ($data) {
                  if ($data->employee_rl){
                      return $data->employee_rl->name;
                  }else{
                      return '';
                  }
                })
                ->editColumn('type', function ($data) {

                    if ($data->type == 'regular'){
                     return 'منتظمة';
                    }else{
                        return 'غير منتظمة';
                    }

                })
                ->editColumn('pay_status', function ($data) {

                    if ($data->pay_status == 'new'){
                     return 'غير مدفوع';
                    }else{
                        return 'مدفوع';
                    }

                })

                ->addColumn('actions', function ($data) {
                    if ($data->pay_status == 'new' && $data->type == 'regular'){
                        $html = "
                            <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fad fa-edit'></i></button>
                            <button  class='btn mb-2 btn-warning showButton' id='" . $data->id . "'> <i class='fad fa-eye'></i></button>
                           <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fad fa-trash'></i> </button>";
                    }elseif($data->pay_status == 'paid' && $data->type == 'regular'){
                        $html = "<button  class='btn mb-2 btn-warning showButton' id='" . $data->id . "'> <i class='fad fa-eye'></i></button>";
                    }elseif ($data->pay_status == 'new' && $data->type == 'unregular'){
                        $html = "
                            <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fad fa-edit'></i></button>
                           <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fad fa-trash'></i> </button>";
                    }elseif ($data->pay_status == 'paid' && $data->type == 'unregular'){
                        $html = 'ــــ';
                    }else{
                        $html = 'ــــ';
                    }


                    return $html;
                })
                ->rawColumns(['actions','employee','type','pay_status'])->make(true);
        }



        return view(mod_view("HR/hrPredecessor/index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()){
            $returnHTML = view(mod_view("HR/hrPredecessor/parts/create"))
                ->with([
                    'employees' => HrEmployee::latest()->get()
                ])
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->only('date','employee_id','pay_status',
            'type','created_by','value');

        $employee = HrEmployee::findOrFail($request->employee_id);

        $store = HrEmployeeSalaryAdvance::create($data);


            $CountValues = count($request->value_);
        if ($CountValues != 1){
            for ($i = 0; $i < $CountValues; $i++) {

                $newArray = array(
                    'value' => $request->value_[$i],
                    'date' => $request->date_[$i],
                    'type' => $request->type,
                    'pay_status' => $request->pay_status,
                    'employee_id' => $request->employee_id,
                    'salary_advance_id' => $store->id,
                );

                HrEmployeeSalaryAdvanceInstallment::create($newArray);
            }
        }



        $this->add_log_activity($store,auth()->user(),"تم حفظ سلفة جديدة ل {$employee->name} ");

        return response()->json(1,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if ($request->ajax()){
            $returnHTML = view(mod_view("HR/hrPredecessor/parts/show"))
                ->with([
                    'employees' => HrEmployee::latest()->get(),
                    'find' => HrEmployeeSalaryAdvance::
                    with('details_rl','employee_rl')->findOrFail($id)
                ])
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        if ($request->ajax()){
            $returnHTML = view(mod_view("HR/hrPredecessor/parts/edit"))
                ->with([
                    'employees' => HrEmployee::latest()->get(),
                    'find' => HrEmployeeSalaryAdvance::
                    with('details_rl','employee_rl')->findOrFail($id)
                ])
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('date','employee_id','pay_status',
            'type','created_by','value');

        $employee = HrEmployee::findOrFail($request->employee_id);

         HrEmployeeSalaryAdvance::findOrFail($id)->update($data);


        HrEmployeeSalaryAdvanceInstallment::where('salary_advance_id',$id)->delete();

        $CountValues = count($request->value_);
        if ($CountValues != 0){
            for ($i = 0; $i < $CountValues; $i++) {

                $newArray = array(
                    'value' => $request->value_[$i],
                    'date' => $request->date_[$i],
                    'type' => $request->type,
                    'pay_status' => $request->pay_status,
                    'employee_id' => $request->employee_id,
                    'salary_advance_id' => $id,
                );

                HrEmployeeSalaryAdvanceInstallment::create($newArray);
            }
        }



        $this->add_log_activity(HrEmployeeSalaryAdvance::findOrFail($id),auth()->user(),"تم تعديل سلفة  ل {$employee->name} ");

        return response()->json(1,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = HrEmployeeSalaryAdvance::with('employee_rl')->findORfail($id);

        $this->add_log_activity($find,auth()->user(),"تم حذف سلفة لـ$find->employee_rl->name");


        $find->delete();

        return response()->json(1,200);
    }//end fun

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_all(Request $request){
        if (isset($request->id)&&is_array($request->id)) {
            foreach ($request->id as $id){
                $data = Brand::findOrFail($id);
                $this->add_log_activity($data,auth()->user()," تم حذف  الماركة {$data->name}");
            }
        }

        Brand::destroy($request->id);
        return response()->json(1,200);
    }//end fun
}
