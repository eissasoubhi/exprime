@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
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
								<th>Type</th>
								<th>Code</th>
								<th>Message</th>
								<th>Fichier</th>
								<th>Ligne</th>
								<th>Url</th>
								<th>Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($app_errors as $error)
							    <tr>
									<td> {{$error->type}}</td>
									<td> {{$error->code}}</td>
									<td> {{$error->clipedMsg()}}</td>
									<td> {{$error->clipedFile()}}</td>
									<td> {{$error->line}}</td>
									<td> {{$error->url}}</td>
									<td> {{$error->created_at}}</td>
									<td>
										<a class="button" href="{{ route('admin.error.show', $error->id);}}"><i class="fa fa-eye"></i></a>
										
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.error.destroy', $error->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							</tr>

						</tbody>
					</table>
					{{$app_errors->links()}}			
		</div>	
	@stop