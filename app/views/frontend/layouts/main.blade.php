<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{$title}}</title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates|Montserrat' rel='stylesheet' type='text/css'>
	{{ HTML::style('libs/font-awesome-4.3.0/css/font-awesome.min.css'); }}
	{{ HTML::style('libs/bootstrap-3.2.0/css/bootstrap.css'); }}
	{{ HTML::style('libs/bootstrap-multiselect/bootstrap-multiselect.css'); }}
	{{ HTML::style('libs/animate/animate.min.css'); }}
	{{ HTML::style('libs/select2/select2.css'); }}
	{{ HTML::style('libs/bootstrap-tagsinput/bootstrap-tagsinput.css'); }}
	{{ HTML::style('css/default.css'); }}
	{{ HTML::script('libs/jquery/jquery.1.11.2.min.js'); }}
	{{ HTML::script('libs/bootstrap-multiselect/bootstrap-multiselect.js'); }}
	{{ HTML::script('libs/bootstrap-3.2.0/js/bootstrap.min.js'); }}
	{{ HTML::script('libs/wow.js/wow.min.js'); }}
	{{ HTML::script('libs/select2/select2.min.js'); }}
	{{ HTML::script('libs/typeahead.bundle/typeahead.bundle.js'); }}
	@if(Session::has('freewall_resources'))
		{{ HTML::script('libs/freewall/freewall.js'); }}
	@endif
	@if(Session::has('ajax_file_upload_resources'))
		{{ HTML::script('js/ajax.file.upload.jquery.js'); }}
	@endif
	@if(Session::has('uploadify_resources'))
		{{ HTML::script('libs/uploadify/jquery.uploadify.min.js'); }}
		{{ HTML::style('libs/uploadify/uploadify.css'); }}
	@endif
	@if(Session::has('ckeditor_resources'))
		{{ HTML::script('libs/ckeditor/ckeditor.js')}}
	@endif
	@if(Session::has('jscroll_resources'))
		{{ HTML::script('libs/jscroll/jquery.jscroll.min.js')}}
	@endif
	@if(Session::has('feather'))
		{{ HTML::script('http://feather.aviary.com/js/feather.js')}}
	@endif
	@if(Session::has('visible_resources'))
		{{ HTML::script('libs/jquery-visible/jquery.visible.min.js')}}
	@endif
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			currentPage = '{{url(Route::current()->getPath())}}';
			$('.navbar-nav a[href="'+ currentPage +'"]').parent().addClass('current');
		});
	</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	@include('frontend.partials.navbar-fixed-top')
	<div class="container page">
 		@yield('content')
 	</div>
    @include('frontend.partials.footer')
 	@include('frontend.partials.modal')
 	<div id="overly"><i class="fa fa-refresh fa-spin"></i></div>
    {{ HTML::script('js/default.js'); }}
    {{ HTML::script('libs/bootstrap-tagsinput/bootstrap-tagsinput.js'); }}
  </body>
</html>