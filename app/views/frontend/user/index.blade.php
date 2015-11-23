@extends('frontend.layouts.main')
	@section('content')
        <div class="slider row">

            <h1>Exprimez-vous plus avec des images <span>:)</span></h1>
            <a href="{{url('explorer')}}" class="explore btn btn-primary fadeIn wow animated" title="Explorer"><i class="fa fa-search"></i> Explorer</a>
            <div class="overly" ></div>
        </div>
        <div class="content container">
            <div class="row fadeIn wow animated">
                <div class="description col-md-10">
                    <h2>Rendez vos commentaires sur Facebook plus <span class="label label-primary">expressives</span></h2>
                    <h3>Introduction</h3>
                    <p class="text">
                        <span>Exprime</span> est un site qui permet aux utilisateurs de Facebook notamment les marocains de trouver images (trolls) qui pourraient être utilisés dans les commentaires Facebook pour être plus expressif, et ils peuvent également créer leurs propres images trolls.
                    </p>
                    <h3>Comment utiliser Exprime !</h3>
                    <p class="text">
                        Vous pouvez <a href="{{url('explorer')}}" title="explorer">explorer</a>  les images trolls  classées par date d'ajout ou les chercher dans le champ de recherche de la barre de menu.

                        Une fois que votre image troll désirée a été trouvé , vous pouvez la télécharger ou obtenir le lien por la partager ou l'utliser dans vos commentaires sur Facebook.

                        Exprime vous permet ainsi d'ajouter vos propres images trolls , mais pour ce faire, vous devez vous <a href="{{url('sign-up')}}" title="inscrivez vous" >inscrire</a> rapidement.

                        Avoir un compte Exprime donne accès à de nombreuses avantages (liste de vos images trolls favorisées ,texte des images personnalisé, commentaires ...)
                    </p>
                </div><div class="image col-md-2">
                    <img class="img-responsive" src="img/img-cmt.png"><br>
                    <img class="img-responsive"  src="img/social-media.png">
                </div>
                <div class="more-info col-md-12">

                    <a href="{{url('page/à-propos')}}" class="learn-more btn btn-primary" title="En savoir plus">En savoir plus</a><br><br>
                    @if(Auth::guest())
                        <span class="text-muted">C'est votre première visite ?</span>
                        <a href="{{url('sign-up')}}" class="sing-up " title="Créer un compte">Créer un compte</a>
                    @endif
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
        	$('.page').addClass('container-fluid').removeClass('container');
        </script>
	@stop