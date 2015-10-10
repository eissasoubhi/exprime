@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		<h1>Photo {{$picture->name}}</h1>
		 	</div>
		 	<div class="form ">
		 		@if($errors->all())
					<div class="error-msg msg">
			 			@foreach ($errors->all() as $error)
						    <p>{{ $error}}</p>
						@endforeach
			 		</div>
		 		@endif
		 		@if(Session::has('errors2'))
					<div class="error-msg msg">
			 			@foreach (Session::get('errors2') as $msg)
						    <p>{{ $msg}}</p>
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
		 		{{ Form::model($picture,array('method' => 'PUT', 'files' => true, 'route' => ['admin.picture.update', $picture->id])) }}
		 			{{ HTML::image('content/'.$picture->url_origin, '', array('class' => 'img-picture-preview')) }}
	 				<div class="form_group">
		 				{{Form::label('new_picture', 'Nouvelle photo : ')}} {{Form::file('new_picture')}}
		 			</div>
		  			<div class="form_group">
						{{Form::label('validated', 'Validée : ')}} {{Form::select('validated', array('1' => 'Oui', '0' => 'Non'), $picture->validated )}}
		  			</div>
		  			<div class="form_group">
						{{Form::label('keywords', 'Les mots cles : ')}} {{Form::select('keywords',$all_keywords , $picture_keywords , array("multiple", 'name' => 'keywords[]'))}}
		  			</div>
		  			
		  			<div class="btn-panel">
		  				<button class="button-ok" type="submit" title="Valider"><i class="fa fa-check"></i>Modifer</button>
		  				<a class="button" href="{{ url('admin/picture')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Annuler</a>
		  			</div>
				{{ Form::close() }}	
		 	</div>
		 	
		</div>	
		<script  type="text/javascript">
			$("#keywords").select2({
			    placeholder: "Ajoutez des mots cles.",
			    allowClear: true,
			     maximumSelectionSize: 5 
			});
		</script>
	@stop