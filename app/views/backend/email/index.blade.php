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
								<th>Sujet</th>
								<th>Email</th>
								<th>Nom Complet</th>
								<th>Contenu</th>
								<th>Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mails as $mail)
							    <tr>
									<td> {{$mail->subject}}</td>
									<td> {{$mail->email}}</td>
									<td> {{$mail->fullname}}</td>
									<td> {{$mail->clipedContent()}}</td>
									<td> {{$mail->created_at}}</td>
									<td>
										<a class="button" href="{{ route('admin.email.show', $mail->id);}}"><i class="fa fa-eye"></i></a>
										
										{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.email.destroy', $mail->id]))}}
											<button class="button" type="submit"><i class="fa fa-times"></i></button>
										{{Form::close()}}
									</td>
								</tr>
							@endforeach
							
							</tr>

						</tbody>
					</table>
					{{$mails->links()}}			
		</div>	
	@stop