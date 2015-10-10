@extends('frontend.layouts.main')
	@section('content')
        <div class="row message-block text-center ">
         @if(isset($error))
            <div class="alert alert-danger bounce animated col-md-6 col-md-offset-3 ">
                {{$error}}
            </div>
          @endif
          @if(isset($message))
            <div class="alert alert-success  col-md-6 col-md-offset-3" >
              {{$message}}
            </div>
           @endif
           <div class="col-md-12">
               <a href="/" class="btn btn-primary"><i class="fa fa-home"></i> Page d'accueil</a>
           </div>
           
        </div>
        <script type="text/javascript" charset="utf-8">
          $('.page').addClass('container-fluid').removeClass('container');
        </script>
	@stop