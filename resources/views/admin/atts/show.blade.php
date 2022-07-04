@extends('layouts.admin.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.att.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.att.fields.id') }}
                        </th>
                        <td>
                            {{ $att->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.att.fields.name') }}
                        </th>
                        <td>
                            {{ $att->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.att.fields.value') }}
                        </th>
                        <td>
                            {{ $att->value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#att_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="att_products">
            @includeIf('admin.atts.relationships.attProducts', ['products' => $att->attProducts])
        </div>
    </div>
</div>

@endsection
