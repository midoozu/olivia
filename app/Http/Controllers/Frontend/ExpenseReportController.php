<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseReportController extends Controller
{
    public function index()
    {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            request()->query('y', Carbon::now()->year),
            request()->query('m', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $expenses = Expense::with('expense_category')->where('branch_id', Auth::user()->branch_id)
            ->whereDate('entry_date', Carbon::today());

        $incomes = Income::with('income_category')->where('branch_id', Auth::user()->branch_id)
            ->whereDate('entry_date',Carbon::today());

        $expensesTotal   = $expenses->sum('amount');
        $incomesTotal    = $incomes->sum('amount');
        $groupedExpenses = $expenses->whereNotNull('expense_category_id')->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        $groupedIncomes  = $incomes->whereNotNull('income_category_id')->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $profit          = $incomesTotal - $expensesTotal;

        $expensesSummary = [];
        foreach ($groupedExpenses as $exp) {
            foreach ($exp as $line) {
                if (!isset($expensesSummary[$line->expense_category->name])) {
                    $expensesSummary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }
                $expensesSummary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $incomesSummary = [];
        foreach ($groupedIncomes as $inc) {
            foreach ($inc as $line) {
                if (!isset($incomesSummary[$line->income_category->name])) {
                    $incomesSummary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }
                $incomesSummary[$line->income_category->name]['amount'] += $line->amount;
            }
        }

        return view('frontend.expenseReports.index', compact(
            'expensesSummary',
            'incomesSummary',
            'expensesTotal',
            'incomesTotal',
            'profit'
        ));
    }
}
