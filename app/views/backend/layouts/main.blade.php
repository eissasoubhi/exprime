<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>{{$title}}</title>
	<!-- <link rel="stylesheet" href="../libs/bootstrap-3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../libs/bootstrap-3.2.0/css/bootstrap-theme.min.css"> -->
	<!-- <script src="../libs/bootstrap-3.2.0/js/bootstrap.min.js"></script> -->
	{{ HTML::style('libs/font-awesome-4.3.0/css/font-awesome.min.css'); }}
	{{ HTML::style('css/css.css'); }}
	{{ HTML::script('libs/jquery/jquery.1.11.2.min.js'); }}
	{{ HTML::script('libs/freewall/freewall.js'); }}

	@if(Session::has('select2_resources'))
		{{ HTML::script('libs/select2/select2.min.js'); }}
		{{ HTML::style('libs/select2/select2.css'); }}
	@endif
	@if(Session::has('uploadify_resources'))
		{{ HTML::script('libs/uploadify/jquery.uploadify.min.js'); }}
		{{ HTML::style('libs/uploadify/uploadify.css'); }}
	@endif
	@if(Session::has('ckeditor_resources'))
		<script src=""></script>
		{{ HTML::script('http://cdn.ckeditor.com/4.5.1/full/ckeditor.js')}}
		{{-- libs/ckeditor/ckeditor.js --}}
	@endif
	@if(Session::has('jscroll_resources'))
		{{ HTML::script('libs/jscroll/jquery.jscroll.min.js')}}
	@endif
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				currentPage = '{{url(Route::current()->getPath())}}';
				$('.left_menu a[href="'+ currentPage +'"], .photos_btn_menu a[href="'+ currentPage +'"]').addClass('current');
			});
	</script>
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
	<div class="all">
		<div class="header">
			<div class="logo">
				<a href="{{url('admin')}}" title="">{{ HTML::image('img/logo.png') }}</a>
			</div>
			@if(Auth::check() && Auth::user()->hasRole("admin"))
			    @include('backend.partials.top_menu')
				@include('backend.partials.user_menu')
			@endif

			<div class="clear">

			</div>
		</div>

		<div class="page">
			@if(Auth::check() && Auth::user()->hasRole("admin"))
			    @include('backend.partials.left_menu')
			@endif<!--
		 -->@yield('content')
		</div><!-- end of "page" tag -->
			<div class="footer">
				<div class="powered_by">
					Eissa soubhi
				</div>
				<div class="copyright">
					copyright exprime 2014
				</div>
				<div class="clear"></div>
			</div>
		</div>
		{{ HTML::script('js/js.js'); }}
		@if(Session::has('uploadify_resources'))
			<script type="text/javascript">
				<?php $timestamp = time();?>
					$('#pictures_upload').uploadify({
						'formData'     : {
							'timestamp'     : '<?php echo $timestamp;?>',
							'token'     : '<?php echo  Hash::make("}&p@-n@7#)jWf[n6#Vv+2-?x%zmWK.}ERKYp59d?".$timestamp);?>',
							'user_id'     : '<?php echo Auth::id()?>'
						},
						'buttonClass' : 'uploadify-btn',
						'checkExisting'      : '{{url('admin/picture/checkExists');}}',
						'swf'      : '{{url('libs/uploadify/uploadify.swf');}}',
						'uploader' : '{{url('admin/picture/upload');}}',
						'width'    : 160,
						'height'  : 50,
						'buttonText' : 'parcourir...',
						'fileSizeLimit' : '1MB',
						'fileTypeDesc' : 'Images',
        				'fileTypeExts' : '*.png; *.jpg; *.png',
						// 'auto'     : false
						'onUploadSuccess' : function(file, picture, response) {
							// alert(picture);
							$.ajax({
							    url: '{{url('admin/picture')}}',
							    type: 'POST',
							    data: picture,
							    contentType: 'application/json; charset=utf-8',
							    dataType: 'json',
							    success: function(msg) {
							    	if (msg != "1") {
							    		alert(msg);
							    	};

							    }
							});
				        }
					});
			</script>
		@endif
	</body>
	</html>