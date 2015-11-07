    <nav class="navbar navbar-default navbar-fixed-top">

        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand logo" href="{{url('/')}}" title="">{{ HTML::image('img/x-logo.png') }}</a>
            </div>

            <div class="collapse navbar-collapse" id="top-navbar-collapse">
              <ul class="nav navbar-nav">
                <li ><a href="{{url('/')}}">ACCUEIL <span class="sr-only">(courant)</span></a></li>
                <li><a href="{{url('page/about')}}">À PROPOS</a></li>
                <li><a href="{{url('explorer')}}">EXPLORER</a></li>
                <li><a href="{{url('contact')}}">CONTACT</a></li>

              </ul>
                {{ Form::open(array('url' => 'img/search', 'class' => 'navbar-form navbar-left search', 'role' => 'search', 'method' => 'GET')) }}
		            <div class="form-group">
		                <div class="input-group">
		                    <span class="input-group-btn">
		                        <button type="submit" class="btn btn-default " ><i class="fa fa-search"></i></button>
		                    </span>

		                    <input data-role="keyword-search" type="text" class="keyword-search form-control span6" placeholder="Recherche par mot clés..." name="q" value="{{$searched_words or ''}}">
		                    <!-- <span class="input-group-btn">
                            <select class="search_options" multiple="multiple">
                                <optgroup label="Texte options">
                                    <option selected value="2-1">Sans texte</option>
                                    <option selected value="2-2">Avec texte</option>
                                </optgroup>
                            </select>
                        </span> -->
		                </div><!-- /input-group -->
		            </div>
              {{ Form::close() }}
              <ul class="nav navbar-nav navbar-right">
                @if(!Auth::check())
                    <li ><a href="{{url('login')}}"><i class="fa fa-sign-in"></i> Se connecter</a></li>
                    <li ><a href="{{url('sign-up')}}"><i class="fa fa-user-plus"></i> S'inscrire</a></li>
                @else
                    <li class="highlighted" ><a href="{{url('upload')}}"><i class="fa fa-upload"></i> Uploder</a></li>
                    <li class="dropdown">
                      <?php
                        if(Auth::user()->f_name && Auth::user()->l_name)
                        {
                          $user_name = ucfirst(Auth::user()->l_name[0]).".".ucfirst(str_limit(Auth::user()->f_name, 10 ,""));
                        }
                        else
                        {
                          $user_name = ucfirst(Auth::user()->login);
                        }
                       ?>
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> {{e($user_name)}}<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{url('profile')}}"><i class="fa fa-user"></i> Profil</a></li>
                        <li><a href="{{url('likes')}}"><i class="fa fa-thumbs-up"></i> Images aimées</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
                      </ul>
                    </li>
                @endif
              </ul>
              {{ Form::open(array('url' => 'img/search', 'class' => 'navbar-form navbar-left hidden-search', 'role' => 'search', 'method' => 'GET')) }}
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default " ><i class="fa fa-search"></i></button>
                        </span>

                        <input data-role="keyword-search" type="text" class="keyword-search form-control span6" placeholder="Recherche par mot clés..." name="q" value="{{$searched_words or ''}}">
                        <!-- <span class="input-group-btn">
                            <select class="search_options" multiple="multiple">
                                <optgroup label="Texte options">
                                    <option selected value="2-1">Sans texte</option>
                                    <option selected value="2-2">Avec texte</option>
                                </optgroup>
                            </select>
                        </span> -->
                    </div><!-- /input-group -->
                </div>
              {{ Form::close() }}
            </div>
        </div>
    </nav>