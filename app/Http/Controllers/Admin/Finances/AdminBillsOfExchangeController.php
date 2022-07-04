<?php

namespace App\Http\Controllers\Admin\Finances;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Account;
use App\Models\Bond;
use App\Models\PaymentType;
use App\Models\PrintSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminBillsOfExchangeController extends Controller
{
    use LogActivityTrait,Upload_Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = Bond::where('type','normal_snd_alsirf')->with('debit_rl','creditor_rl')->orderby('id','DESC')->get();



        //return all Suppliers
        if ($request->ajax()) {

            $datas = Bond::where('type','normal_snd_alsirf')->with('debit_rl','creditor_rl')->orderby('id','DESC')->get();



            return DataTables::of($datas)

                ->addColumn('placeholder', '&nbsp;')


                ->editColumn('created_at', function ($data) {
                    return date('Y/m/d',strtotime($data->created_at));
                })
                ->editColumn('creditor_rl', function ($data) {
                    if ($data->creditor_rl){
                        return $data->creditor_rl->name;
                    }else{
                        return '';
                    }
                })
                ->editColumn('value', function ($data) {
                    return $data->value . ' جنيه ';
                })
                ->editColumn('image', function ($data) {
                    return '<img src="'.get_file($data->image).'" class=" rounded" style="height:50px;width:50px"
                             onclick="window.open(this.src)">';
                })
                ->editColumn('debit_rl', function ($data) {
                    if ($data->debit_rl){
                        return $data->debit_rl->name;
                    }else{
                        return '';
                    }
                })

//                ->addColumn('delete_all', function ($data) {
//                    return "<input type='checkbox' class=' delete-all' data-tablesaw-checkall name='delete_all' id='" . $client->id . "'>";
//                })
                ->addColumn('actions', function ($data) {
                    if ($data->is_confirmed == 'new'){
                        $html = "
                    <a href='".route('admin.billsOfExchange.show',$data->id)."'  class='btn mb-2 btn-warning' id='" . $data->id . "'> <i class='fa fa-eye'></i></a>
                    <a href='".route('admin.billsOfExchange.edit',$data->id)."' class='btn mb-2 btn-secondary' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                     <form  method='post' action='".route('admin.billsOfExchange.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                    </form>
                                        <a href='".route('admin.billsOfExchange.print',$data->id)."'  class='btn mb-2 btn-info' id='" . $data->id . "'> <i class='fa fa-print'></i></a>
                        ";
                    }else{
                        $html = "
                    <a href='".route('admin.billsOfExchange.print',$data->id)."'  class='btn mb-2 btn-info' id='" . $data->id . "'> <i class='fa fa-print'></i></a>
                    <a href='".route('admin.billsOfExchange.show',$data->id)."'  class='btn mb-2 btn-warning' id='" . $data->id . "'> <i class='fa fa-eye'></i></a>";
                    }

                    return $html;
                })
                ->rawColumns(['actions','placeholder','created_at','debit_rl','image','value','creditor_rl'])->make(true);



        }


        return view('admin.Finances.billsOfExchange.index',compact($datas));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $bank_accounts = Account::FilterForPurchases(5)->get();

        $box_accounts = Account::FilterForPurchases(6)->get();

            $returnHTML = view("admin.Finances.billsOfExchange.parts.add_form")
                ->with([
                    'madins' => Account::all(),
                    'box_accounts' => $box_accounts,
                    'bank_accounts' => $bank_accounts,
                    'pay_types' => PaymentType::orderBy('id','DESC')->get(),
                ]);

            return $returnHTML;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'date'=>'required',
            'debit_id'=>'required',
            'value'=>'required',
            'type'=>'required',
            'payment_type'=>'required',
            'statement'=>'nullable',
            'image'=>'nullable',
        ]);

        if ($request->payment_type == 'check'){
            $data['check_number'] = $request->check_number;
            $data['creditor_id'] = $request->bank_id;
            $data['check_date'] = $request->check_date;

        }elseif('cash'){
            $data['creditor_id'] = $request->box_id;


        }

        if ($request->hasFile('image')){
            $data ['image'] = store_file($request,'image','bond');
        }
        $row = Bond::create($data);

        //log activities

        toastr()->success('تم الحفظ بنجاح');

        return redirect()->route('admin.billsOfExchange.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {


        $bank_accounts = Account::FilterForPurchases(5)->get();

        $box_accounts = Account::FilterForPurchases(6)->get();
        $find = Bond::with('creditor_rl')->findOrFail($id);
            $returnHTML = view("admin.Finances.billsOfExchange.parts.show")
                ->with([
                    'madins' => Account::all(),
                    'box_accounts' => $box_accounts,
                    'bank_accounts' => $bank_accounts,
                    'find' => $find,
                    'pay_types' => PaymentType::orderBy('id','DESC')->get(),
                ]);

            return $returnHTML;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {

        $bank_accounts = Account::FilterForPurchases(5)->get();

        $box_accounts = Account::FilterForPurchases(6)->get();
        $find = Bond::with('creditor_rl')->findOrFail($id);

        if ($find->is_confirmed != 'new'){
            toastr()->warning('لا يمكن التعديل');
            return  back();
        }

            $returnHTML = view("admin.Finances.billsOfExchange.parts.edit_form")
                ->with([
                    'madins' => Account::all(),
                    'box_accounts' => $box_accounts,
                    'bank_accounts' => $bank_accounts,
                    'find' => $find,
                    'pay_types' => PaymentType::orderBy('id','DESC')->get(),
                ]);

        return $returnHTML;

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
        $data = $this->validate($request,[
            'date'=>'required',
            'debit_id'=>'required',
            'value'=>'required',
            'payment_type'=>'required',
            'type'=>'required',
            'statement'=>'nullable',
            'image'=>'nullable',
        ]);

        if ($request->payment_type == 'check'){
            $data['check_number'] = $request->check_number;
            $data['creditor_id'] = $request->check_id;

            $data['check_date'] = $request->check_date;


        }else{

            $data['creditor_id'] = $request->money_id;


        }

        if ($request->hasFile('image')){
            $data ['image'] = store_file($request,'image','bond');
        }
        Bond::findorFail($id)->update($data);

        //log activities
        toastr()->success('تم الحفظ بنجاح');

        return redirect()->route('admin.billsOfExchange.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Bond::destroy($id);

        toastr()->info('تم الحذف');

        return redirect()->route('admin.billsOfExchange.index');

    }//end fun

    public function print($id){
        $find = Bond::with('creditor_rl','debit_rl')->findOrFail($id);

        $printsetting = PrintSetting::first();


        return view('admin.Finances.billsOfExchange.print',compact('find','printsetting'));
    }//end fun
}
