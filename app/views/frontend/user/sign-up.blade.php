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
                <div class="col-md-6 col-md-offset-3 register form-block">
                    <h1>Inscrivez vous</h1>
                    <a class="sign-in-link" href="{{url('login')}}" title="vous avez déja un compte ?">vous avez déja un compte ?</a>
                    <div class="form-group ">
                      <label class="control-label" for="inputGroupSuccess1">Adresse e-mail* </label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="email" required class="form-control" name="email" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="form-group ">
                      <label class="control-label" for="inputGroupSuccess1">Nom d'utilisateur* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" required minlength="5" class="form-control" name="login" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="form-group ">
                      <label class="control-label"for="inputGroupSuccess1">Mot de passe* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password"  minlength="8"  required class="form-control" name="password" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="form-group ">
                      <label class="control-label" required minlength="8"  for="inputGroupSuccess1">Confirmez le mot de passe* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password_confirmation" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="checkbox">
                      <label>
                        <input required type="checkbox" name="terms"> J'ai lu les <a href="{{url('page/termes')}}" title="Condition et termes d'utilisation " >Conditions et termes</a> d'utilisation
                      </label>
                    </div>
                    <button type="submit" name="sign-up-submit" class="show-overly btn btn-block btn-primary"><span class="glyphicon glyphicon-ok"></span> S'inscrire</button>
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
