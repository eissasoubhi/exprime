@extends('frontend.layouts.main')
  @section('content')
    <div class="container-fluid page">
        <div class="content container">
            <div class="row fadeIn wow animated">
                <div class="col-md-3" >
                  <div class="form-block">             
                    <div class="bs-example" data-example-id="vertical-button-group">
                      <div class="btn-group-vertical btn-block img-left-menu" role="group" aria-label="Vertical button group">
                          <a class="btn btn-default "><i class="fa fa-edit"> Modifier</i></a>
                          <a class="btn btn-default"><i class="fa fa-download"> Téléchargez </i></a>
                          <a class="btn btn-default"><i class="fa fa-link"> Lien</i></a>
                          <a class="btn btn-default"><i class="fa fa-heart"> Ajouter aux favoris</i></a>
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
                      {{Form::open(array('method' => 'DELETE', 'url' => ['img/picture/destroy/'.$image->id]))}}
                          <button type="submit"  class="btn btn-danger" ><i class="fa fa-remove"></i> Supprimer</button>
                      {{Form::close()}}
                        <div class="uploaded-img">
                          <div class="table-cell"><img src="{{url('content/'.$image->url_origin)}}" class="img-responsive" id="{{$image->id}}"></div>
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
                            {{Form::open(array('id' => 'commentUpdateForm'.$comment->id, 'class' => 'btn-group btn-group-xs', 'url' => ['img/comment/update/'.$comment->id]))}}
                              <button type="submit" class="btn btn-warning edit-comment"> <i class="fa fa-edit"> </i> </button>
                             {{Form::close()}}
                              {{Form::open(array('method' => 'DELETE','class' => 'btn-group btn-group-xs', 'url' => ['img/comment/destroy/'.$comment->id]))}}
                                <button type="submit" class="btn btn-danger"> <i class="fa fa-remove"> </i> </button>
                            {{Form::close()}}
                          </div>
                      </div>
                      <div class="panel-body">
                        {{$comment->content}}
                      </div>
                    </div>
                  </div>
                </div>                
              @endforeach

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

        </div>
    </div><!-- /.container -->
  @stop