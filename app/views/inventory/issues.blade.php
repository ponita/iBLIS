@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('user.home')}}}">{{trans('messages.home')}}</a></li>
	  <li><a href="{{{URL::route('inventory.labStockCard')}}}">{{ trans('messages.inventory') }}</a></li>
	  <li class="active">{{ Lang::choice('messages.labStockCardIssues',2) }}</li>
	</ol>
</div>
@if (Session::has('message'))
	<div class="alert alert-info">{{ trans(Session::get('message')) }}</div>
@endif
<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-user"></span>
		{{trans('messages.labStockCard')}}
		{{trans('messages.labStockCardIssues')}}
		
	</div>
	<div class="panel-body">
		 
            {{ Form::open(array('url' => 'role', 'id' => 'form-create-role')) }}

            <div class="form-group">
                {{ Form::label('Commodity', trans('messages.commodity')) }}
                {{ Form::text('commodity', Input::old('commodity'), array('class' => 'form-control', 'rows' => '2')) }}
            </div>
             <div class="form-group">
                {{ Form::label('Batch No. ', trans('messages.batch-no')) }}
                {{ Form::label('batch-no', Input::old('qty'),array('class' => 'form-control', 'rows' => '2')) }}
            </div>
            <div class="form-group">
                {{ Form::label('Expiry Date', Lang::choice('messages.expiry-date',1)) }}
                {{ Form::label('expiry-date', Input::old('expiry-date'), array('class' => 'form-control standard-datepicker')) }}
            </div>

            <div class="form-group">
                {{ Form::label('Quantity Available ', trans('messages.qty-avl')) }}
                {{ Form::label('qty-avl', Input::old('qty-avl'),array('class' => 'form-control', 'rows' => '2')) }}
            </div>
            <div class="form-group">
                {{ Form::label('Quantity', trans('messages.qty-req')) }}
                {{ Form::text('qty-req', Input::old('qty-req'),array('class' => 'form-control', 'rows' => '2')) }}
            </div>
            <div class="form-group">
                {{ Form::label('Destination ', trans('messages.destination')) }}
                {{ Form::text('destination', Input::old('destination'),array('class' => 'form-control', 'rows' => '2')) }}
            </div>
            <div class="form-group">
                {{ Form::label('Receivers Name ', trans('messages.receivers-name')) }}
                {{ Form::text('receivers-name', Input::old('receivers-name'),array('class' => 'form-control', 'rows' => '2')) }}
            </div>            

                      





            <div class="form-group actions-row">
                    {{ Form::button("<span class='glyphicon glyphicon-save'></span> ".trans('messages.save'), 
                        array('class' => 'btn btn-primary', 'onclick' => 'submit()')) }}
            </div>
        {{ Form::close() }}



		
		<?php  
		Session::put('SOURCE_URL', URL::full());?>
	</div>
	
</div>
@stop