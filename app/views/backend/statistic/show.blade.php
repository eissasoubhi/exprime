@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="show ">
		 		
		 		<div>
		 			{{Form::label('city', 'Ville : ')}} <strong >{{$statistic->city}} </strong>
		 		</div>
		 		<div>
		 			{{Form::label('country', 'Payé : ');}} <strong >{{$statistic->country }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('url', 'Url : ');}} <strong >{{$statistic->url }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('flag', 'Drapeau : ');}} <img width="40" src="{{$statistic->flag}}" alt="">
		 		</div>
		 		<div>
		 			{{Form::label('time', 'Date : ');}} <strong >{{$statistic->time }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('count', 'Nb visites (h) : ');}} <strong >{{$statistic->count }}</strong>
		 		</div>
		 		
		  		<a class="button" href="{{ url('admin/statistic')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Retour</a>
		 	</div>
		 	
		</div>	
	@stop