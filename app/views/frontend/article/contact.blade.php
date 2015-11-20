@extends('frontend.layouts.main')
  @section('content')
        <div class="content container">
            <div class="row fadeIn wow animated">
            	<div class="col-md-3">
				 	@if($errors->all())
						<div class="error-msg msg">
				 			@foreach ($errors->all() as $error)
							    <p>{{ $error}}</p>
							@endforeach
				 		</div>
			 		@endif
			 		@if(Session::has('messages'))
						<div class="alert alert-success">
				 			@foreach (Session::get('messages') as $msg)
							    <p>{{ $msg}}</p>
							@endforeach
				 		</div>
			 		@endif
            	</div>
                <div class="col-md-6 form-block">
                    <h1>Contectez nous</h1>
                    <div class="infos-form-block ">
                        <strong class="company">
                            Exprime
                        </strong>
                        <div class="inf mail">
                            <label >E-mail : </label>
                            <span class="pull-right">contact@exprime.ma</span>
                        </div>
                        {{-- <div class="inf tel">
                            <label>Téléphone : </label>
                            <span class="pull-right">06 63 31 77 40</span>
                        </div> --}}
                        <div class="inf sn">
                            <label>Réseaux sociaux : </label>
                            <span class="pull-right">
                                <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a> <span> | </span>
                                <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                            </span>
                        </div>
                    </div>
                    <form action="" method="POST" accept-charset="utf-8">
	                    <div class="form-group ">
	                      <label class="control-label" for="inputGroupSuccess1">Votre adresse e-mail* </label>
	                      <div class="input-group">
	                        <span class="input-group-addon">@</span>
	                        <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" name="email">
	                      </div>
	                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	                    </div>

	                    <div class="form-group ">
	                      <label class="control-label" for="inputGroupSuccess1">Nom complet* </label>
	                      <div class="input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                        <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" name="full-name">
	                      </div>
	                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	                    </div>

	                    <div class="form-group ">
	                      <label class="control-label" for="inputGroupSuccess1">Objet* </label>
	                      <div class="input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	                        <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" name="subject">
	                      </div>
	                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	                    </div>

	                    <div class="form-group ">
	                      <label class="control-label" for="inputGroupSuccess1">Message* </label>
	                      <div class="input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	                        <textarea type="text" rows="5" class="form-control input-lg" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" name="message"></textarea>
	                      </div>
	                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	                    </div>
	                    <button type="submit" class="btn show-overly btn-block btn-lg btn-primary"><span class="glyphicon glyphicon-ok"></span> Envoyer</button>
                	</form>
                </div>
            </div>
        </div>
  @stop
