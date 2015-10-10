@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
		 	<div class="title">
		 		<h1>Utilisateur {{$user->login}}</h1>
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
		 		{{ Form::model($user,array('method' => 'PUT', 'route' => ['admin.user.update', $user->id])) }}
		  				<div class="form_group">
		 					{{Form::label('email', 'Email : ');}} {{Form::text('email')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('login', 'nom d\'utilisateur : ')}} {{Form::text('login')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('old_password', 'Ancien mot de passe : ')}} {{Form::password('old_password')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('new_password', 'Nouveau mot de passe : ')}} {{Form::password('new_password')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('new_password_confirmation', 'Confirmation de nouveau mot de passe : ')}} {{Form::password('new_password_confirmation')}}
			 			</div>
			 			<div class="form_group">	
			 				{{Form::label('role', 'Role : ')}} 
			 				<select name="role">
			 					@foreach ($roles as $role)
			 						<option value="{{$role->id}}">{{$role->name}}</option>
								@endforeach
			 				</select>
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('l_name', 'Nom : ')}} {{Form::text('l_name')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('f_name', 'Prenom : ')}} {{Form::text('f_name')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('country', 'Pays : ')}} {{Form::text('country')}}
			 			</div>
			 			<div class="form_group">
			 				{{Form::label('city', 'Ville : ')}} {{Form::text('city')}}
			 			</div>
		  			<div class="btn-panel">
		  				<button class="button-ok" type="submit" title="Valider"><i class="fa fa-check"></i>Modifer</button>
		  				<a class="button" href="{{ url('admin/user')}}" type="button" title="Annuler"><i class="fa fa-arrow-left"></i>Annuler</a>
		  			</div>
				{{ Form::close() }}	
		 	</div>
		 	
		</div>	
	@stop