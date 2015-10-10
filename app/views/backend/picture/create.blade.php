@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		<h1>Nouvelle(s) photo(s)</h1>
		 	</div>
		 	<div class="form ">
				<div class="error-msg msg">
		 			<p>Dés que les photos sont sélectionnées l'upload va commencer automatiquement !</p>
		 		</div>
		 		@if(Session::has('messages'))
					<div class="ok-msg msg">
			 			@foreach (Session::get('messages') as $msg)
						    <p>{{ $msg}}</p>
						@endforeach
			 		</div>
		 		@endif
		 		{{ Form::open() }}
		  			 {{Form::file('pictures', array('id' => 'pictures_upload', 'multiple' => 'true'))}}
		  			<div class="btn-panel">
		  				<!-- <a class="button-ok" href="javascript:$('#pictures_upload').uploadify('upload')" title="Ajouter"><i class="fa fa-check"></i>Ajouter</a> -->
		  				<a class="button" href="{{ url('admin/picture')}}" taype="button" title="Annuler"><i class="fa fa-arrow-left"></i>Annuler</a>
		  			</div>
		  			

				{{ Form::close() }}	
		 	</div>
		 	
		</div>	
	@stop