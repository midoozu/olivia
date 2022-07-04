<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Invoice_service;
use App\Models\InvoicesType;
use App\Models\PaymentType;
use App\Models\PrintSetting;
use App\Models\ReceiptVoucher;
use App\Models\Service;
use App\Models\ShippingAndClearance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoicesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Invoice::with(['trx_number', 'inv_type', 'pay_type', 'cus_name', 'ship_name'])->select(sprintf('%s.*', (new Invoice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'invoice_show';
                $editGate      = 'invoice_edit';
                $deleteGate    = 'invoice_delete';
                $crudRoutePart = 'invoices';


                $html = "
                <a  class='fas fa-eye' href='". route('admin.' . $crudRoutePart . '.show', $row->id)."'></a>
                <a class='far fa-edit'  href='". route('admin.' . $crudRoutePart . '.show', $row->id)."'> </a>

                    <form action='".route('admin.' . $crudRoutePart . '.destroy', $row->id)."' method='POST' onclick='return confirm(".trans('global.areYouSure').");' style='color:red;'>
                         <input type='hidden' name='_method' value='DELETE'>
                         <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <a class='fas fa-trash-alt'></a>
                    </form>

                        <a  class='fas fa-print' href='".route('admin.' . $crudRoutePart .'.print', $row->id) ."'></a>
                ";

                return $html;

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('trx_number_transaction_number', function ($row) {
                return $row->trx_number ? $row->trx_number->transaction_number : '';
            });

            $table->editColumn('trx_number.transaction_date', function ($row) {
                return $row->trx_number ? (is_string($row->trx_number) ? $row->trx_number : $row->trx_number->transaction_date) : '';
            });

            $table->addColumn('inv_type_invoice_type', function ($row) {
                return $row->inv_type ? $row->inv_type->invoice_type : '';
            });

            $table->addColumn('pay_type_payment_type', function ($row) {
                return $row->pay_type ? $row->pay_type->payment_type : '';
            });

            $table->addColumn('cus_name_name', function ($row) {
                return $row->cus_name ? $row->cus_name->name : '';
            });

            $table->editColumn('cus_name.acc_number', function ($row) {
                return $row->cus_name ? (is_string($row->cus_name) ? $row->cus_name : $row->cus_name->acc_number) : '';
            });
            $table->editColumn('cus_name.type', function ($row) {
                return $row->cus_name ? (is_string($row->cus_name) ? $row->cus_name : $row->cus_name->type) : '';
            });
            $table->addColumn('ship_name_ship_name', function ($row) {
                return $row->ship_name ? $row->ship_name->ship_name : '';
            });

            $table->editColumn('ship_name.int_order_no', function ($row) {
                return $row->ship_name ? (is_string($row->ship_name) ? $row->ship_name : $row->ship_name->int_order_no) : '';
            });
            $table->editColumn('ship_name.shipping_policy_number', function ($row) {
                return $row->ship_name ? (is_string($row->ship_name) ? $row->ship_name : $row->ship_name->shipping_policy_number) : '';
            });
            $table->editColumn('ship_name.arrival_date', function ($row) {
                return $row->ship_name ? (is_string($row->ship_name) ? $row->ship_name : $row->ship_name->arrival_date) : '';
            });
            $table->editColumn('ship_name.shipment_type', function ($row) {
                return $row->ship_name ? (is_string($row->ship_name) ? $row->ship_name : $row->ship_name->shipment_type) : '';
            });
            $table->editColumn('shipped_from', function ($row) {
                return $row->shipped_from ? $row->shipped_from : "";
            });
            $table->editColumn('import_statement', function ($row) {
                return $row->import_statement ? $row->import_statement : "";
            });

            $table->editColumn('no_of_packages', function ($row) {
                return $row->no_of_packages ? $row->no_of_packages : "";
            });
            $table->editColumn('pay_order_no', function ($row) {
                return $row->pay_order_no ? $row->pay_order_no : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'trx_number', 'inv_type', 'pay_type', 'cus_name', 'ship_name']);

            return $table->make(true);
        }

        $shipping_and_clearances = ShippingAndClearance::get();
        $invoices_types          = InvoicesType::get();
        $payment_types           = PaymentType::get();
        $clients                 = Client::get();

        return view('admin.invoices.index', compact('shipping_and_clearances', 'invoices_types', 'payment_types', 'clients'));
    }



    public function findprice(Request $request)
    {


        $data = Service::where('id', $request->id)->fisrt();

        return response()->json($data);

    }


    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trx_numbers = ShippingAndClearance::all()->pluck('shipping_policy_number', 'id')->prepend(trans('global.pleaseSelect'), '');

    $receiptvoucher =   ReceiptVoucher::all()->pluck('id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inv_types = InvoicesType::all()->pluck('invoice_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pay_types = PaymentType::all()->pluck('payment_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cus_names = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_names = ShippingAndClearance::all()->pluck('ship_name', 'id')->prepend(trans('global.pleaseSelect'), '');
$servics = Service::all();
        return view('admin.invoices.create', compact('trx_numbers', 'inv_types', 'pay_types', 'cus_names', 'ship_names','servics','receiptvoucher'));
    }

    public function store(StoreInvoiceRequest $request)
    {
dd($request);
        $invoice = Invoice::create($request->all());
           $id =$invoice->id ;
        if ($invoice->id !=0){
            foreach ( $request->servicename as    $key => $s)
            {
                $data = array(

                    'service_id' => $request->servicename[$key] ,
                    'amount' =>$request-> amount[$key] ,
                    'tax_percentage' => $request->tax_percentage[$key] ,
                    'tax_amount' => $request->tax_amount[$key] ,
                    'total' =>$request->total[$key] ,
                    'invoice_id'=>$id,

                );
                invoice_service::create($data);

            }}

        return redirect()->route('admin.invoices.index');
    }

    public function print($id)

    {
        abort_if(Gate::denies('shipping_and_clearance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice = Invoice::with('trx_number','pay_type','invoice_Services.Services','cus_name','ship_name','invoice_Services')->where('id',$id)->first();
        $printsetting  = PrintSetting::first();

        return view('admin.invoices.print', compact('invoice', 'printsetting'));

    }

    public function edit(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trx_numbers = ShippingAndClearance::all()->pluck('transaction_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inv_types = InvoicesType::all()->pluck('invoice_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pay_types = PaymentType::all()->pluck('payment_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cus_names = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_names = ShippingAndClearance::all()->pluck('ship_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoice->load('trx_number', 'inv_type', 'pay_type', 'cus_name', 'ship_name');

        return view('admin.invoices.edit', compact('trx_numbers', 'inv_types', 'pay_types', 'cus_names', 'ship_names', 'invoice'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('admin.invoices.index');
    }

    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->load('trx_number', 'inv_type', 'pay_type', 'cus_name', 'ship_name');

        return view('admin.invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        Invoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
