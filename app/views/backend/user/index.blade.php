@extends('backend.layouts.main')
	@section('content')<!--
	 --><div class="content">
				<div class="photos_btn_menu">
					<ul>
						<a href="{{url('admin')}}">Toutes</a>
						<a href="{{url('admin/picture/named')}}">Avec nom et/ou mots cles</a>
						<a href="{{url('admin/picture/unnamed')}}">Sans nom et mots cles</a>
					</ul>
				</div>
				<div class="photos_gallery">
					<div class="list-thumbs">
						<div id="container" class="grid-layout">
							@foreach ($pictures as $picture)
								<div class="brick" >
									<div class="overflow">
										<div class="img-close" >
											{{Form::open(array('method' => 'DELETE','class'=>'btn-form', 'route' => ['admin.picture.destroy', $picture->id]))}}
												<button class="a" type="submit"><i class="fa fa-trash"></i></button>
											{{Form::close()}}
											<div class="clear"></div>
										</div>
                                        <div class="hover-btns">
                                            <a  data-toggle="modal" data-target="#picture-link" data-pic-link="{{url('content/'.$picture->name)}}"><i class="fa fa-link"></i></a>
                                            @if(Auth::check())
                                                <a href="{{e(url('img/edit/'.$picture->id).'?next='.Request::path())}}" title="{{e($picture->name)}}">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            @endif
                                            @if(Auth::check())
                                                <a target="_blank" class="img-like-btn" data-img-like="{{url('img/toggleLike/'.$picture->id)}}" title="">
                                                    @if($picture->has('likes'))
                                                        {{$picture->likes()->count()}}
                                                    @else
                                                        0
                                                    @endif
                                                    @if(Auth::check() && $picture->isLiked(Auth::user()->id))
                                                        <i class="fa fa-heart"></i>
                                                    @else
                                                        <i class="fa fa-heart-o"></i>
                                                    @endif
                                                </a>
                                            @endif

                                            <a href="{{url('img/show/'.$picture->id.'/'.($picture->name() ? $picture->name() : $picture->firstKeyWord))}}" title="">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <div class="clear"></div>
                                        </div>
									</div>
									<div class="img" style="background-image: url({{url('content/'.$picture->url_origin)}})">
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