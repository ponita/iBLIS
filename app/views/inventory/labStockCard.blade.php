@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('user.home')}}}">{{trans('messages.home')}}</a></li>
	  <li class="active">{{ Lang::choice('messages.labStockCard',2) }}</li>
	</ol>
</div>
@if (Session::has('message'))
	<div class="alert alert-info">{{ trans(Session::get('message')) }}</div>
@endif
<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-user"></span>
		{{trans('messages.inventory-list')}}
		<div class="panel-btn">
			<a class="btn btn-sm btn-info" href="{{ URL::route('inventory.receipts') }}">
				<span class="glyphicon glyphicon-plus-sign"></span>
				{{trans('messages.labStockCardReceipts')}}
			</a>
			<a class="btn btn-sm btn-info" href="{{ URL::route('inventory.issues') }}">
				<span class="glyphicon glyphicon-plus-sign"></span>
				{{trans('messages.labStockCardIssues')}}
			</a>
		</div>
	</div>
	<div class="panel-body">
		
<table class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th>{{Lang::choice('messages.lab-receipt-date',1)}}</th>
					<th>{{Lang::choice('messages.commodity',1)}}</th>
					<th>{{Lang::choice('messages.batch-no',1)}}</th>
					<th>{{Lang::choice('messages.expiry-date',1)}}</th>
					<th>{{Lang::choice('messages.qty',1)}}</th>
					<th>{{Lang::choice('messages.qty-issued',1)}}</th>
					<th>{{Lang::choice('messages.stock-bal',1)}}</th>

					
				</tr>
			</thead>

			<tbody>
			<tr>
				</tr>				
			</tbody>
			</table>




		<?php  
		Session::put('SOURCE_URL', URL::full());?>
	</div>
	
</div>
@stop