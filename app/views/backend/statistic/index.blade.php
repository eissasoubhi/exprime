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
								<th>Ville</th>
								<th>Payé</th>
								<th>Url</th>
								<th>Drapeau</th>
								<th>Date</th>
								<th>Nb visites (h)</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($statistics as $statistic)
							    <tr>
									<td> {{$statistic->city}}</td>
									<td> {{$statistic->country}}</td>
									<td> {{$statistic->clipedUrl()}}</td>
									<td> <img width="40" src="{{$statistic->flag}}" alt=""> </td>
									{{-- <td>test<img width="40" src="http://www.geobytes.com/flags/mo-flag.gif" alt=""> </td> --}}
									<td> {{$statistic->time}}</td>
									<td> {{$statistic->count}}</td>
									<td>
										<a class="button" href="{{ route('admin.statistic.show', $statistic->id);}}"><i class="fa fa-eye"></i></a>
										
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.statistic.destroy', $statistic->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							{{-- </tr> --}}

						</tbody>
					</table>
					{{$statistics->links()}}			
		</div>	
	@stop