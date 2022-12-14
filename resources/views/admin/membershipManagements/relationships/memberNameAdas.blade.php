@can('ada_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.adas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ada.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.ada.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-memberNameAdas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.member_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.award_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.date_awarded') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.award_validity') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.awarding_body') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.award_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.ada.fields.note') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adas as $key => $ada)
                        <tr data-entry-id="{{ $ada->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ada->id ?? '' }}
                            </td>
                            <td>
                                {{ $ada->member_name->member_name ?? '' }}
                            </td>
                            <td>
                                {{ $ada->award_name ?? '' }}
                            </td>
                            <td>
                                {{ $ada->date_awarded ?? '' }}
                            </td>
                            <td>
                                {{ $ada->award_validity ?? '' }}
                            </td>
                            <td>
                                {{ $ada->awarding_body ?? '' }}
                            </td>
                            <td>
                                {{ $ada->award_status ?? '' }}
                            </td>
                            <td>
                                {{ $ada->note ?? '' }}
                            </td>
                            <td>
                                @can('ada_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.adas.show', $ada->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ada_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.adas.edit', $ada->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ada_delete')
                                    <form action="{{ route('admin.adas.destroy', $ada->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('ada_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.adas.massDestroy') }}",
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
  let table = $('.datatable-memberNameAdas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection