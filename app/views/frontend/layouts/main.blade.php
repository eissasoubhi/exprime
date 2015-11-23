<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{$title." - ".$page_title}}</title> {{-- $page_title and $title are definded in routes file --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Exprime est un site responsive Créé par eissa soubhi,  il permet aux utilisateurs de Facebook notamment les marocains de trouver images (trolls) qui pourraient être utilisés dans les commentaires Facebook pour être plus expressif, et ils peuvent également créer leurs propres images trolls. | Exprime is a responsive website created by eissa soubhi allows Facebook users mostly Moroccan users to find memes pictures that could be used in facebook comments to be more expressive, and they can also create their own memes." />
    <meta name="keywords" content="{{$website_keywords.', '.$page_keywords}}" />
    <!-- <link rel="shortcut icon" href="{{url('favicon.ico')}}" /> -->
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="{{url('icons/favicon.ico')}}" /><![endif]-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('icons/apple-touch-icon-57x57.png')}}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('icons/apple-touch-icon-114x114.png')}}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('icons/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('icons/apple-touch-icon-144x144.png')}}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('icons/apple-touch-icon-60x60.png')}}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('icons/apple-touch-icon-120x120.png')}}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('icons/apple-touch-icon-76x76.png')}}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('icons/apple-touch-icon-152x152.png')}}" />
    <link rel="icon" type="image/png" href="{{url('icons/favicon-196x196.png" sizes="196x196')}}" />
    <link rel="icon" type="image/png" href="{{url('icons/favicon-160x160.png" sizes="160x160')}}" />
    <link rel="icon" type="image/png" href="{{url('icons/favicon-96x96.png" sizes="96x96')}}" />
    <link rel="icon" type="image/png" href="{{url('icons/favicon-32x32.png" sizes="32x32')}}" />
    <link rel="icon" type="image/png" href="{{url('icons/favicon-16x16.png" sizes="16x16')}}" />
    <meta name="msapplication-TileColor" content="#bf3e11" />
    <meta name="msapplication-TileImage" content="{{url('icons/mstile-144x144.png')}}" />

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
			currentPage = '{{Route::current() !== null  ? url(Route::current()->getPath()) : "404"}}';
			$('.navbar-nav a[href="'+ currentPage +'"]').parent().addClass('current');
		});
	</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-70399180-1', 'auto');
        ga('send', 'pageview');

    </script>
  </head>
  <body>
  	@include('frontend.partials.navbar-fixed-top')
	<div class="container page">
 		@yield('content')
 	</div>
    @include('frontend.partials.footer')
 	@include('frontend.partials.modal')
 	<div id="overly"><i class="fa fa-refresh fa-spin"></i></div>
    {{ HTML::script('libs/modernizr/modernizr-touch-events.js'); }}
    {{ HTML::script('js/default.js'); }}
    {{ HTML::script('libs/bootstrap-tagsinput/bootstrap-tagsinput.js'); }}
  </body>
</html>