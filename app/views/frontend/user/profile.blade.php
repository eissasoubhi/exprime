@extends('frontend.layouts.main')
	@section('content')
        <div class="content container">
            <div class="row fadeIn wow animated">
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
                <div class="col-md-6 col-md-offset-3 sign-in form-block"> 
                    <form action="" method="POST" accept-charset="utf-8">
                        <h1>Profil</h1>
                        <div class="form-group ">
                          <label class="control-label" for="inputGroupSuccess1">Adresse e-mail* </label>
                          <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" disabled class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" value="{{$user->email}}">
                          </div>
                          <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group ">
                          <label class="control-label" for="inputGroupSuccess1">Nom d'utilisateur* </label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" name="login" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" value="{{$user->login}}">
                          </div>
                          <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group ">
                          <label class="control-label" for="inputGroupSuccess1">Nom </label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="l_name" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" value="{{$user->l_name}}"> 
                          </div>
                          <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group ">
                          <label class="control-label" for="inputGroupSuccess1">Prenom </label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="f_name" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" value="{{$user->f_name}}">
                          </div>
                          <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <a class=" editpass show-wait" data-wait=".wait-editpass" href="{{url('password/reset')}}" title="Modifier le mot de passe">Modifier le mot de passe</a><span class="msg-wait wait-editpass"><i class="fa fa-refresh fa-spin"></i></span>
                        <button type="submit" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-ok"></span> Modifier</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
          $('.page').addClass('container-fluid').removeClass('container');
        </script>
	@stop
