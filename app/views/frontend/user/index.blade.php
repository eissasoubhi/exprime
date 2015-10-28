@extends('frontend.layouts.main')
	@section('content')
        <div class="slider row">

            <h1>Exprimez-vous plus avec des photos commentées <span>:)</span></h1>
            <a href="{{url('explorer')}}" class="explore btn btn-primary fadeIn wow animated" title="Explorer"><i class="fa fa-search"></i> Explorer</a>
            <div class="overly" ></div>
        </div>
        <div class="content container">
            <div class="row fadeIn wow animated">
                <div class="description col-md-10">
                    <h2>Commentez et partagez des photos sur les <span class="label label-primary">réseaux sociaux</span></h2>
                    <p class="text">
                        <span>Exprime</span> vous permet d'<span>ajouter et commenter</span> des photos pour les utiliser dans les commentaires sur les réseaux sociaux. <br>
                        Vous pouvez egalement creer vos <span>propre listes</span> des photos que vous aimez. <br>
                        Enfin offre des dizain des photos commentées et non commentées dont vous pouvez <span>cherchez</span> par des mots cles et par texte de commentaire
                    </p>
                </div><div class="image col-md-2">
                    <img class="img-responsive" src="img/img-cmt.png"><br>
                    <img class="img-responsive"  src="img/social-media.png">
                </div>
                <div class="more-info col-md-12">

                    <a href="#" class="learn-more btn btn-primary" title="En savoir plus">En savoir plus</a><br><br>
                    <span class="text-muted">C'est votre prmiere visite ?</span>
                    <a href="#" class="sing-up " title="Créer un compte">Créer un compte</a>
                </div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8">
        	$('.page').addClass('container-fluid').removeClass('container');
        </script>
	@stop