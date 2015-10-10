@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
				<div class="login">
					<div class="top-icon">
					</div>
					<div class="login-form">
						@if(($all_errors = $errors->all()) || ($all_errors = Session::get('errors')))
							<div class="error-msg msg">
					 			@foreach ($all_errors as $error)
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
						<form action="" method="POST" accept-charset="utf-8">
							<input class="input-login" name="login" placeholder="Login" type="text"><div class="left-icon"></div>
							<input class="input-pass" name="password" placeholder="Mot de passe" type="password"><div class="left-icon"></div>
							<div class="ctrl">
								<input type="checkbox" value="None" id="remember" name="save_cnt" />
								{{Form::token();}}
								<label for="remember">Garder ma session active</label>
								<button type="submit" class="login-btn flat-btn" href="#" title="Connexion">Connexion</button>
							</div>	
							
						</form>
						
					</div>
				</div>
				<div class="login-msg">
					
				</div>
			</div>	
	@stop
