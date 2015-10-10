@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		{{Form::label('name', 'Nom : ')}} <strong>{{$article->name}}</strong>
		 	</div>
		 	<div class="show ">
		 		
		 		<div>
		 			{{Form::label('date', 'Date : ');}} <strong >{{$article->created_at }}</strong>
		 		</div>
		 		{{Form::label('content', 'Contenu : ')}} 
		 		<div class="content-text">
		 				{{$article->content }}
		 		</div>
		  		<a class="button" href="{{ url('admin/article')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Retour</a>
		 	</div>
		 	
		</div>	
	@stop