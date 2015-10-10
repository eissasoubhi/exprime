@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
	 	<a class="button-new" href="{{ url('admin/picture/create')}}" title="Nouvelle(s) photo(s)"><i class="fa fa-plus-circle"></i>Nouvelle(s) photo(s)</a>
	 	@if($errors->all())
			<div class="error-msg msg">
	 			@foreach ($errors->all() as $error)
				    <p>{{ $error}}</p>
				@endforeach
	 		</div>
 		@endif
 		@if(Session::has('errors'))
			<div class="error-msg msg">
	 			@foreach (Session::get('errors') as $msg)
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
			<table class="grid">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Poids</th>
								<th>Taille</th>
								<th>Aperçu</th>
								<th>Texte</th>
								<th>Validé</th>
								<th>Ajouté par</th>
								<th>Crée à</th>
								<th>Modifiée à</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($pictures as $picture)
							    <tr>
									<td> {{$picture->clipedName()}}</td>
									<td> {{$picture->sizeUnit()}}</td>
									<td> {{$picture->dimension}}</td>
									<td>
										<div class="picture-preview" style="background-image: url({{url('content/'.$picture->url_origin);}});">
										</div>
									</td>
									<td> 
									</td><!-- texte -->
									<td> {{$picture->validated}}</td>
									<td>{{$picture->user->login}} </td>
									<td> {{$picture->created_at}}</td>
									<td> {{$picture->updated_at}}</td>
									<td>
										<a class="button" href="{{ route('admin.picture.edit', $picture->id);}}"><i class="fa fa-pencil-square-o"></i></a>
										
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.picture.destroy', $picture->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							</tr>

						</tbody>
					</table>		
					{{$pictures->links()}}	
		</div>	
	@stop