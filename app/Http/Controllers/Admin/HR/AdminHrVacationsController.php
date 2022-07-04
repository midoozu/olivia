<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\HrVacations;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminHrVacationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = HrVacations::orderby("id","DESC")->get();

        if ($request->ajax()){
            return DataTables::of($datas)


                ->addColumn('placeholder', '&nbsp;')
                ->editColumn('type', function ($data) {
                    if ($data->type == 'official'){
                        return 'رسمية';
                    }else{
                        return 'غير رسمية';
                    }
                })

                ->addColumn('actions', function ($data) {
                    $html = "
                    <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></button>
                   <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>";

                    return $html;
                })
                ->rawColumns(['actions','type','placeholder'])->make(true);
        }



        return view("admin/HR/Setting/Vacations/index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()){
            $returnHTML = view("admin/HR/Setting/Vacations/parts/create")
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

        $data = $request->only('type','title');


        $store = HrVacations::create($data);




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
        $find = HrVacations::find($id);

        $returnHTML = view("admin/HR/Setting/Vacations/parts/edit")
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
        $old = HrVacations::find($id);

        $data = $request->only('title');


        HrVacations::find($id)->update($data);


        $new = HrVacations::find($id);


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
        $find = HrVacations::find($id);



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
                $data = HrVacations::findOrFail($id);
            }
        }

        HrVacations::destroy($request->id);
        return response()->json(1,200);
    }//end fun
}
