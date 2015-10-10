@extends('frontend.layouts.main')
  @section('content')
        <div class="content container-fluid">
            <div class="row fadeIn wow animated">
              <div class="col-md-12 text-article">
                {{$article->content}}
              </div>
            </div>
        </div>
  @stop