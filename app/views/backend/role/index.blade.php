@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
	 	<a class="button-new" href="{{ url('admin/role/create')}}" title="Nouveau role"><i class="fa fa-plus-circle"></i>Nouveau role</a>
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
								<th>nom</th>
								<th>date de creàtion</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($roles as $role)
							    <tr>
									<td> {{$role->name}}</td>
									<td> {{$role->created_at}}</td>
									<td>
										<a class="button" href="{{ route('admin.role.edit', $role->id);}}"><i class="fa fa-pencil-square-o"></i></a>
										
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.role.destroy', $role->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							</tr>

						</tbody>
					</table>		
					{{$roles->links()}}	
		</div>	
	@stop