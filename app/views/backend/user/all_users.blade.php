@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
	 	<a class="button-new" href="{{ url('admin/user/create')}}" title="Nouveau user"><i class="fa fa-plus-circle"></i>Nouvel utilisateur</a>
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
	 	
			<table class="grid">
						<thead>
							<tr>
								<th>Login</th>
								<th>Email</th>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Pays</th>
								<th>Ville</th>
								<th>Creé à</th>
								<th>Nb conne.</th>
								<th>Dérniere conne.</th>
								<th>Role</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							    <tr>
									<td> {{$user->login}}</td>
									<td> {{$user->email}}</td>
									<td> {{$user->l_name}} </td>
									<td> {{$user->f_name}} </td>
									<td> {{$user->country}} </td>
									<td> {{$user->city}} </td>
									<td> {{$user->created_at}} </td>
									<td> {{$user->count_sign_in}} </td>
									<td> {{$user->last_sign_in}} </td>
									<td> {{$user->role->name}} </td>
									<td>
										<a class="button" href="{{ route('admin.user.edit', $user->id)}}"><i class="fa fa-pencil-square-o"></i></a>
										
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.user.destroy', $user->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							</tr>

						</tbody>
					</table>	
					{{$users->links()}}	
		</div>	
	@stop