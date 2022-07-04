@extends('layouts.admin.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.expense.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.expenses.update", [$expense->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="expense_category_id">{{ trans('cruds.expense.fields.expense_category') }}</label>
                            <select class="form-control select2" name="expense_category_id" id="expense_category_id">
                                @foreach($expense_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('expense_category_id') ? old('expense_category_id') : $expense->expense_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('expense_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expense_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.expense_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="entry_date">{{ trans('cruds.expense.fields.entry_date') }}</label>
                            <input class="form-control date" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date', $expense->entry_date) }}" required>
                            @if($errors->has('entry_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('entry_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.entry_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.expense.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $expense->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_expenses_id">{{ trans('cruds.expense.fields.cs_expenses') }}</label>
                            <select class="form-control select2" name="cs_expenses_id" id="cs_expenses_id">
                                @foreach($cs_expenses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('cs_expenses_id') ? old('cs_expenses_id') : $expense->cs_expenses->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cs_expenses'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_expenses') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.cs_expenses_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="branch_id">{{ trans('cruds.expense.fields.branch') }}</label>
                            <select class="form-control select2" name="branch_id" id="branch_id" required>
                                @foreach($branches as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('branch_id') ? old('branch_id') : $expense->branch->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.expense.fields.branch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
