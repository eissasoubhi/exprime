
@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		<h1>Nouveau mot clé </h1>
		 	</div>
		 	<div class="form ">
		 		@if($errors->all())
					<div class="error-msg msg">
			 			@foreach ($errors->all() as $error)
						    <p>{{ $error}}</p>
						@endforeach
			 		</div>
		 		@endif
		 		@if(Session::has('messages'))
					<div class="ok-msg msg">
			 			@foreach (Session::get('messages') as $msg)
						    <p>{{ $msg}}</p>
						@endforeach
			 		</div>
		 		@endif
		 		{{ Form::open(array('url' => 'admin/keyword')) }}
		 			<div class="form_group">
	 					{{Form::label('keyword', "Mot clé : ");}} {{Form::text('keyword');}}
		 			</div>
		  			<div class="form_group">
	 					{{Form::label('content');}} {{Form::textarea ('content','', array("id" => "ckeditor"))}} 
		 			</div>
		  			<div class="btn-panel">
		  				<button class="button-ok" type="submit" title="Valider"><i class="fa fa-check"></i>Valider</button>
		  				<a class="button" href="{{ url('admin/keyword')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Annuler</a>
		  			</div>
		  			
				{{ Form::close() }}	
		 	</div>
		 	
		</div>	
		<script type="text/javascript">
			window.onload = function()
			{
				CKEDITOR.replace( 'content' );
			};
		</script>
	@stop