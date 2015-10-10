@extends('backend.layouts.main')
	@section('content')<!-- 
	 --><div class="content">
				<!-- <div class="photos_btn_menu">
					<ul>
						<a href="#">Toutes</a>
						<a href="#">Validés</a>
						<a href="#">Non Validés</a>
					</ul>
				</div> -->
				<div class="photos_gallery">
					<div class="list-thumbs">
						<div id="container" class="grid-layout">
							@foreach ($pictures as $picture)
								<div class="brick" >
									<div class="overflow">
										<div class="img-close" > 
											{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.picture.destroy', $picture->id]))}}
												<button class="a" type="submit"><i class="fa fa-times"></i></button>
											{{Form::close()}}
											<div class="clear"></div> 
										</div> 
										<div class="hover-btns"> 
											<a href="#" title="">
												<i class="fa fa-download"></i>
											</a> 
											<a href="#" title="">
												<i class="fa fa-pencil-square-o"></i>
											</a> 
											<a href="#" title="">
												100 <i class="fa fa-heart"></i>
											</a> 
											<a href="#" title="">
												20 <i class="fa fa-comment"></i>
											</a> 
											<div class="clear"></div> 
										</div>
									</div>
									<div class="img" style="background-image: url(content/{{$picture->url_origin}})">
										<div class="view-hover">
											<img  src="" alt="">
											<div class="title">
												{{$picture->name}}
											</div>
										</div>
									</div>
								</div> 
							@endforeach
							<div class="clear"></div>
							{{$pictures->links()}}	
						</div>
						 
					</div>
				</div>
				
			</div>	
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#container').jscroll({
					    padding: 20,
					    nextSelector: ".pagination li:last a",
					    contentSelector: '.brick, .pagination',
					    pagingSelector: '.pagination',
					    loadingHtml: '<div class="load">{{ HTML::image("img/load.gif") }}</div>'
					});
				});	
			</script>
	@stop