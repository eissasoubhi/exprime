@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
	 	<a class="button-new" href="{{ url('admin/keyword/create')}}" title="Nouveau keyword"><i class="fa fa-plus-circle"></i>Nouveau mot clé</a>
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
								<th>Mot clé</th>
								<th>Nombre de photos</th>
								<th>Créé par</th>
								<th>date de creàtion</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($keywords as $keyword)
							    <tr>
									<td> {{$keyword->keyword}}</td>
									<td>{{$keyword->picturesCount() }}</td>
									<td> {{$keyword->user->login}}</td>
									<td> {{$keyword->created_at}}</td>
									<td>
										<a class="button" href="{{ route('admin.keyword.edit', $keyword->id);}}"><i class="fa fa-pencil-square-o"></i></a>
										<a class="button" href="{{ route('admin.keyword.show', $keyword->id);}}"><i class="fa fa-eye"></i></a>
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.keyword.destroy', $keyword->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							</tr>

						</tbody>
					</table>		
					{{$keywords->links()}}	
		</div>	
	@stop