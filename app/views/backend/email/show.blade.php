@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		{{Form::label('subject', 'Sujet : ')}} <strong>{{$email->subject}}</strong>
		 	</div>
		 	<div class="show ">
		 		
		 		<div>
		 			{{Form::label('from', 'De : ')}} <strong >{{$email->fullname }} ( {{$email->email }} )</strong>
		 		</div>
		 		<div>
		 			{{Form::label('date', 'Date : ');}} <strong >{{$email->created_at }}</strong>
		 		</div>
		 		{{Form::label('content', 'Contenu : ')}} 
		 		<div class="content-text">
		 			
		 			<p >
		 				{{$email->content }}
		 			</p>
		 		</div>
		  		<a class="button" href="{{ url('admin/email')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Retour</a>
		 	</div>
		 	
		</div>	
	@stop