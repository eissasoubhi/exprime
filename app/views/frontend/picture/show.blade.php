@extends('frontend.layouts.main')
  @section('content')
    <div class="container-fluid page">
        <div class="content container">
            <div class="row fadeIn wow animated">
                <div class="col-md-3" >
                  <div class="form-block">
                    <div class="bs-example" data-example-id="vertical-button-group">
                      <div class="btn-group-vertical btn-block img-left-menu" role="group" aria-label="Vertical button group">
                        @if(Auth::check())
                            <a href="{{url('img/edit/'.$image->id)}}" class="btn btn-default "><i class="fa fa-edit"> Modifier</i></a>
                        @endif
                          <a href="{{url('img/download/'.$image->name)}}" class="btn btn-default"><i class="fa fa-download"> Téléchargez </i></a>
                          <a class="btn btn-default" data-toggle="modal" data-target="#picture-link" data-link="{{url('content/'.$image->name)}}"><i class="fa fa-link"> Lien</i></a>
                          @if(Auth::check())
                              <a class="btn btn-default img-like-btn-text" data-img-like="{{url('img/toggleLike/'.$image->id)}}">
                                    @if(Auth::check() && $image->isLiked(Auth::user()->id))
                                        <i class="fa fa-heart"></i>
                                        Enlever des favoris
                                    @else
                                        <i class="fa fa-heart-o"></i>
                                        Ajouter aux favoris
                                    @endif
                              </a>
                          @endif
                      </div>
                      </div>
                  </div>
                  <div class="form-group message">
                    @if($errors->all())
                      <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error}}</p>
                        @endforeach
                      </div>
                    @endif
                    @if(Session::has('messages'))
                      <div class="alert alert-succes">
                        @foreach (Session::get('messages') as $msg)
                            <p>{{ $msg}}</p>
                        @endforeach
                      </div>
                    @endif
                  </div>
                </div>
                    <div class="col-md-6 col-md-offset-1 upload form-block">
                        @if(Auth::check() and ($image->belongsToUser(Auth::user()) or Auth::user()->hasAnyRole(array('admin','modirator'))))
                            {{Form::open(array('method' => 'DELETE', 'url' => ['img/picture/destroy/'.$image->id]))}}
                                <button type="submit"  class="btn btn-danger" ><i class="fa fa-remove"></i> Supprimer</button>
                            {{Form::close()}}
                        @endif
                        <div class="uploaded-img">
                          <div class="table-cell"><img src="{{url('content/'.$image->url_origin.'?'.(!$image->name() ? $image->firstKeyWord : ($image->firstKeyWord ? $image->firstKeyWord : $image->name() )))}}" class="img-responsive" id="{{$image->id}}"></div>
                        </div>
                    </div>
            </div>
              <div class="row comments-title">
                <div class="col-sm-12">
                  <h3>Les commentaires des utilisateurs</h3>
                </div><!-- /col-sm-12 -->
              </div><!-- /row -->
                @foreach($image->comments()->get() as $comment)
                    <div class="row comment">
                      <div class="col-sm-1">
                        <div class="thumbnail">
                          <div class="user-photo text-center">
                            <i class="fa fa-user fa-4x"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <strong>{{$comment->user->login}}</strong> <span class="text-muted">a commenté le {{$comment->created_at}}</span>
                              <div class="btn-group btn-group-xs pull-right" role="group" >
                                @if(Auth::check() and ($comment->belongsToUser(Auth::user()) or Auth::user()->hasAnyRole(array('admin','modirator'))))
                                    {{Form::open(array('id' => 'commentUpdateForm'.$comment->id, 'class' => 'btn-group btn-group-xs', 'url' => ['img/comment/update/'.$comment->id]))}}
                                      <button type="submit" class="btn btn-warning edit-comment"> <i class="fa fa-edit"> </i> </button>
                                    {{Form::close()}}
                                    {{Form::open(array('method' => 'DELETE','class' => 'btn-group delete-comment btn-group-xs', 'url' => ['img/comment/destroy/'.$comment->id]))}}
                                        <button type="submit" class="btn btn-danger"> <i class="fa fa-remove"> </i> </button>
                                    {{Form::close()}}
                                @endif
                              </div>
                          </div>
                          <div class="panel-body">
                            {{nl2br($comment->content)}}
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
                @if(Auth::check())
                    {{ Form::open(array('url' => 'img/comment/store')) }}
                        <div class="row new-comment">
                          <div class="col-sm-1">
                            <div class="thumbnail">
                              <div class="user-photo text-center">
                                <i class="fa fa-user fa-4x"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-9">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <strong>Nouveau commentaire</strong>
                                <div class="btn-group btn-group-xs pull-right" role="group" >
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> </button>
                                </div>
                              </div>
                              <textarea class="form-control" name="addComment" id="addComment" rows="2"></textarea>
                              <input type="hidden" name="img" value="{{$image->id}}">
                            </div>
                          </div>
                        </div>
                    {{ Form::close() }}
                @else
                    <div class="text-center">
                        <a class="btn btn-success" href="{{url('login').'?next='.Request::path()}}" role="button">Ajouter un commentaire</a>
                    </div>
                @endif
        </div>
    </div><!-- /.container -->
    <div class="modal fade" id="picture-link" tabindex="-1" role="dialog" aria-labelledby="picture-linkLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="picture-linkLabel">Lien de l'image</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="pic-link" class="control-label">ctrl+v pour copier le lien dans le presse papier.</label>
                <input type="text" class="form-control" id="pic-link">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick='' data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
    <script>
    jQuery(document).ready(function($)
    {
        $('#picture-link').on('shown.bs.modal', function (e)
        {
            $(this).find('#pic-link').val($(e.relatedTarget).attr('data-link')).select();
        })
    });
    </script>
  @stop