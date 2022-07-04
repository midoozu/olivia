<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncomeRequest;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\CrmCustomer;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Inventory;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IncomeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomes = Income::with(['income_category', 'cs_name', 'branch'])->where('branch_id', Auth::user()->branch_id)->whereDate('entry_date',Carbon::today() )->get();

        return view('frontend.incomes.index', compact('incomes'));
    }

    public function create()
    {
        abort_if(Gate::denies('income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cs_names = CrmCustomer::pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = Inventory::where('id', Auth::user()->branch_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.incomes.create', compact('income_categories', 'cs_names', 'branches'));
    }

    public function store(StoreIncomeRequest $request)
    {
        $income = Income::create($request->all());

        return redirect()->route('frontend.incomes.index');
    }

    public function edit(Income $income)
    {
        abort_if(Gate::denies('income_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cs_names = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branches = Inventory::where('id', Auth::user()->branch_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income->load('income_category', 'cs_name', 'branch');

        return view('frontend.incomes.edit', compact('income_categories', 'cs_names', 'branches', 'income'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $income->update($request->all());

        return redirect()->route('frontend.incomes.index');
    }

    public function show(Income $income)
    {
        abort_if(Gate::denies('income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->load('income_category', 'cs_name', 'branch');

        return view('frontend.incomes.show', compact('income'));
    }

    public function destroy(Income $income)
    {
        abort_if(Gate::denies('income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncomeRequest $request)
    {
        Income::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
