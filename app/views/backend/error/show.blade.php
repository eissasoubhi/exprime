@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="show ">
		 		
		 		<div>
		 			{{Form::label('type', 'Type : ')}} <strong >{{$error->type}} </strong>
		 		</div>
		 		<div>
		 			{{Form::label('code', 'Code : ');}} <strong >{{$error->code }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('line', 'Ligne : ');}} <strong >{{$error->line }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('url', 'Url : ');}} <strong >{{$error->url }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('date', 'Date : ');}} <strong >{{$error->created_at }}</strong>
		 		</div>
		 		<div>
		 			{{Form::label('File', 'Fichier : ');}} <strong >{{$error->file }}</strong>
		 		</div>
		 		{{Form::label('msg', 'Message : ')}} 
		 		<div class="content-text">
		 			
		 			<p >
		 				{{$error->msg }}
		 			</p>
		 		</div>
		  		<a class="button" href="{{ url('admin/error')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Retour</a>
		 	</div>
		 	
		</div>	
	@stop