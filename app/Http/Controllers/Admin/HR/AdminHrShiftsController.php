<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\HrShifts;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminHrShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = HrShifts::orderby("id","DESC")->get();

        if ($request->ajax()){
            return DataTables::of($datas)
                ->addColumn('placeholder', '&nbsp;')


                ->addColumn('delete_all', function ($data) {
                    return "<input type='checkbox' class=' delete-all' data-tablesaw-checkall name='delete_all' id='" . $data->id . "'>";
                })

                ->addColumn('actions', function ($data) {
                    $html = "
                    <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></button>
                   <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>";

                    return $html;
                })
                ->rawColumns(['actions','placeholder'])->make(true);
        }



        return view("admin/HR/Setting/Shifts/index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()){
            $returnHTML = view("admin/HR/Setting/Shifts/parts/create")
                ->with([
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

        $data = $request->only('title');


        $store = HrShifts::create($data);

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
        $find = HrShifts::find($id);

        $returnHTML = view("admin/HR/Setting/Shifts/parts/edit")
            ->with([
                'find' => $find
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
        $old = HrShifts::find($id);

        $data = $request->only('title');


        HrShifts::find($id)->update($data);


        $new = HrShifts::find($id);


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
        $find = HrShifts::find($id);



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
                $data = HrShifts::findOrFail($id);
            }
        }

        HrShifts::destroy($request->id);
        return response()->json(1,200);
    }//end fun
}
