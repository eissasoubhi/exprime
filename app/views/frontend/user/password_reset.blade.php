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
                    <h1>Choisissez un nouveau mot de passe</h1>
                    <div class="form-group ">
                      <label class="control-label"for="inputGroupSuccess1">Nouveau mot de passe* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password"  minlength="8"  required class="form-control" name="new_password" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="form-group ">
                      <label class="control-label" required minlength="8"  for="inputGroupSuccess1">Confirmer le mot de passe* </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="new_password_confirmation" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                      </div>
                      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <button type="submit" name="sign-up-submit" class="show-overly btn btn-block btn-primary"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                </div>
              </form>   
                
            </div>

        </div>
        <script type="text/javascript" charset="utf-8">
          $('.page').addClass('container-fluid').removeClass('container');
        </script>
	@stop
