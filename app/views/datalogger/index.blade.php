@extends("layout")
@section("content")

@if (Session::has('message'))
<div class="alert alert-info">{{ trans(Session::get('message')) }}</div>
@endif

            <span class="glyphicon glyphicon-refresh"></span>

<br>
<br>
<div class="panel panel-primary">
  <div class="panel-heading ">
    <span class="glyphicon glyphicon-list"></span>
    Data Logger Info
<div class="panel-btn">
		
<a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
		</div>

  </div>
  <div class="panel-body">

    <table class="table table-bordered table-hover table-condensed search-table">
      <thead>
        <tr>
          <th>Test Date</th>
          <th>Sample Origin</th>
	<th>Entry Point</th>
          <th>Sample ID</th>
          <th>Test  Result</th>
          <th>Testing Device</th>
          <th>Tested By</th>
          <th>{{trans('messages.actions')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($logger as $key => $value)
        <tr>
          <td>{{ $value->ResultDateString}}</td>
          <td>{{ $value->SiteName}}</td>
	<td> {{$value->SpecimenSourceString}}</td>
          <td>{{ $value->Sample}}</td>
          <td>{{ $value->ResultValue}}</td>
          <td>{{ $value->DeviceTypeString}}</td>
          <td>{{ $value->Operator}}</td>
          <td>

            <!-- delete this commodity (uses the delete method found at GET /inventory/{id}/delete -->
            <button class="btn btn-sm btn-info delete-item-link"
            
            <span class="glyphicon glyphicon-edit"></span>
            {{trans('messages.edit')}}
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <?php Session::put('SOURCE_URL', URL::full());?>
</div>
</div>
@stop
