<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\HrSonction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminHrSentencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = HrSonction::orderby("id","DESC")->get();

        if ($request->ajax()){
            return DataTables::of($datas)


                ->addColumn('placeholder', '&nbsp;')

                ->addColumn('actions', function ($data) {
                    $html = "
                    <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></button>
                   <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>";

                    return $html;
                })
                ->rawColumns(['actions','placeholder'])->make(true);
        }



        return view("admin/HR/Setting/Sentence/index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()){
            $returnHTML = view("admin/HR/Setting/Sentence/parts/create")
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


        $store = HrSonction::create($data);




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
        $find = HrSonction::find($id);



        $returnHTML = view("admin/HR/Setting/Sentence/parts/edit")
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
        $old = HrSonction::find($id);

        $data = $request->only('title');


        HrSonction::find($id)->update($data);


        $new = HrSonction::find($id);


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
        $find = HrSonction::find($id);



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
                $data = HrSonction::findOrFail($id);
            }
        }

        HrSonction::destroy($request->id);
        return response()->json(1,200);
    }//end fun
}
