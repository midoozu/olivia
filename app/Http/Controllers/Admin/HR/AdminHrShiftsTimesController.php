<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;

use App\Models\HR\HrDepartment;
use App\Models\HR\HrShifts;
use App\Models\HR\HrShiftsTimes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminHrShiftsTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = HrShiftsTimes::with('shift_rl','department_rl')
            ->orderby("id","DESC")->get();

        if ($request->ajax()){
            return DataTables::of($datas)
                ->addColumn('placeholder', '&nbsp;')


                ->editColumn('department', function ($data) {
                    if ($data->department_rl){
                        return $data->department_rl->title;
                    }else{
                        return  ' ';
                    }
                })
                ->editColumn('shift', function ($data) {
                if ($data->shift_rl){
                  return $data->shift_rl->title;
                }else{
                 return  ' ';
                }
                })
                ->editColumn('to_hour', function ($data) {
                    return date('h:i A',strtotime($data->to_hour));
                })
                ->editColumn('from_hour', function ($data) {
                    return date('h:i A',strtotime($data->from_hour));
                })

                ->addColumn('actions', function ($data) {
                    $html = "
                    <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></button>
                   <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>";

                    return $html;
                })
                ->rawColumns(['actions','shift','from_hour','to_hour','department','placeholder'])->make(true);
        }



        return view("admin/HR/Setting/ShiftsTimes/index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()){
            $returnHTML = view("admin/HR/Setting/ShiftsTimes/parts/create")
                ->with([
                    'Shifts'=>HrShifts::latest()->get(),
                    'Departments'=>HrDepartment::latest()->get(),
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

        $data = $request->only('shift_id',
            'department_id','from_hour','to_hour');


        $store = HrShiftsTimes::create($data);




        return response()->json(1,200);

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
        $find = HrShiftsTimes::find($id);



        $returnHTML = view("admin/HR/Setting/ShiftsTimes/parts/edit")
            ->with([
                'find' => $find,
                 'Shifts'=>HrShifts::latest()->get(),
                'Departments'=>HrDepartment::latest()->get(),
            ])
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

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

        $data  = $request->only('shift_id',
            'department_id','from_hour','to_hour');


        HrShiftsTimes::find($id)->update($data);


        $new = HrShiftsTimes::find($id);


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
        $find = HrShiftsTimes::find($id);



        $find->delete();

        return response()->json(1,200);
    }//end fun

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_all(Request $request){
        HrShiftsTimes::destroy($request->id);
        return response()->json(1,200);
    }//end fun
}
