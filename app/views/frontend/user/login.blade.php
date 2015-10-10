@extends('frontend.layouts.main')
	@section('content')
        <div class="content container">
            <div class="row fadeIn  animated">
              @if(($all_errors = $errors->all()) || ($all_errors = Session::get('errors')))
                <div class="alert alert-danger bounce animated col-md-6 col-md-offset-3 ">
                  @foreach ($all_errors as $error)
                      <p>{{ $error}}</p>
                  @endforeach
                </div>
              @endif
              @if(Session::has('messages'))
                <div class="alert alert-success  col-md-6 col-md-offset-3" >
                  @foreach (Session::get('messages') as $msg)
                      <p>{{ $msg}}</p>
                  @endforeach
                </div>
               @endif
              <form action="" method="POST" accept-charset="utf-8">
                {{Form::token();}}
                <div class="col-md-6 col-md-offset-3 sign-in form-block"> 
                    <h1>Connectez vous</h1>

                    <div class="form-group ">
                      <label class="control-label" for="inputGroupSuccess1">Nom d'utilisateur* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" minlength="5"  required  id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" name="login">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="form-group ">
                      <label class="control-label" for="inputGroupSuccess1">Mot de passe* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control"  minlength="8"  required  id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status" name="password">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <a class="register" href="{{url('sign-up')}}" title="Créer un compte">Créer un compte</a>
                    <button type="submit" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-ok"></span> Se connecter</button>
                    <div class="sn-login">
                      <strong class="or">Ou</strong>
                      <a class="sn-fb btn btn-block " href="{{url('fbauth')}}" title="Connexion avec votre compte Facebook"><i class="fa fa-facebook"></i>Se connecter avec un compte Facebook</a>
                      <a class="sn-google btn btn-block " href="{{url('gauth')}}" title="Connexion avec votre compte Google"><i class="fa fa-google-plus"></i>Se connecter avec un compte Google</a>
                    </div>
                </div>
              </form>   
                
            </div>

        </div>
        <script type="text/javascript" charset="utf-8">
          $('.page').addClass('container-fluid').removeClass('container');
        </script>
	@stop
