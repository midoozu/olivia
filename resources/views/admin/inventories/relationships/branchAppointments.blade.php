<div class="m-3">
    @can('appointment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.appointments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-branchAppointments">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.doctor') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.start_time') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.finish_time') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.weight') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.circum') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.comment') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.services') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.pulse') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.branch') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.follow_up') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.check_in') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.check_out') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $key => $appointment)
                            <tr data-entry-id="{{ $appointment->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $appointment->id ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->client->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->client->email ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->client->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->doctor->name ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->start_time ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->finish_time ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->weight ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->circum ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->price ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->comment ?? '' }}
                                </td>
                                <td>
                                    @foreach($appointment->services as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($appointment->products as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $appointment->pulse ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->branch->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $appointment->follow_up ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $appointment->follow_up ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $appointment->check_in ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $appointment->check_in ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $appointment->check_out ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $appointment->check_out ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('appointment_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.appointments.show', $appointment->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('appointment_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.appointments.edit', $appointment->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('appointment_delete')
                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('appointment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.appointments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-branchAppointments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection