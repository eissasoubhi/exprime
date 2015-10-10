@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		{{Form::label('keyword', 'Mot clé : ')}} <strong>{{$keyword->keyword}}</strong>
		 	</div>
		 	<div class="show ">
		 		
		 		<div>
		 			{{Form::label('user', 'Créé par : ');}} <span >{{$keyword->user->login }}</span>
		 		</div>
		 		<div>
		 			{{Form::label('date', 'Date : ');}} <span >{{$keyword->created_at }}</span>
		 		</div>
		 		{{Form::label('content', 'Photos : ')}} 
		 		<div class="content-text pics">
		 				@foreach ($keyword->pictures as $pic)
			 				<div class="pic">
			 					<div class="picture-preview" style="background-image: url({{url('content/'.$pic->url_origin);}});"></div>
							    <span>{{$pic->name}}</span>
			 				</div>  
						@endforeach
		 		</div>
		  		<a class="button" href="{{ url('admin/keyword')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Retour</a>
		 	</div>
		 	
		</div>	
	@stop