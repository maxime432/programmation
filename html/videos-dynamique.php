
<?php
    $menu="Vidéos";

    include("include/connexion.php") ;
    include("include/objet/OVideo.php");
    include("include/objet/OGroupeVideos.php");

    $requete_select = $bdd->prepare('SELECT idx_groupe_videos, nom_groupe_videos, gv.description, date, gv.idx_type_groupe_videos FROM groupe_videos gv
            INNER JOIN type_groupe_videos tgv ON tgv.idx_type_groupe_videos = gv.idx_type_groupe_videos
            WHERE tgv.description=:type ORDER BY date DESC ' );
    $requete_select->execute(array('type' => $type) );

    $donnees_groupe_videos_page = array();
    $donnees_groupe_page = array();

    $donnees_test ;
    while($donnees_groupe_video = $requete_select->fetch(PDO::FETCH_OBJ))
    {
        $groupe_video = new OGroupeVideos() ;
        $groupe_video->idx_groupe_video = $donnees_groupe_video->idx_groupe_video;
        $groupe_video->date = $donnees_groupe_video->date;
        $groupe_video->description = $donnees_groupe_video->description;
        $groupe_video->idx_type_groupe_video = $donnees_groupe_video->idx_type_groupe_video;
        $groupe_video->nom_groupe_video = $donnees_groupe_video->nom_groupe_video;

        $requete_select_videos = $bdd->prepare('SELECT idx_videos_excursions, nom_videos_excursions, description, url, idx_groupe_videos FROM videos_excursions WHERE idx_groupe_videos = :idx_groupe_video ');

        $requete_select_videos->execute(array('idx_groupe_video' => $donnees_groupe_video->idx_groupe_video));

        $compteur_video=0;

        while($donnees_videos = $requete_select_videos->fetch(PDO::FETCH_OBJ))
        {
            $video = new OVideo();
            $video->idx_video = $donnees_videos->idx_videos_excursions;
            $video->nom = $donnees_videos->nom_videos_excursions;
            $video->description = $donnees_videos->description;
            $video->url = $donnees_videos->url ;
            $video->idx_groupe_video = $donnees_videos->idx_groupe_video;

            $donnees_groupe_video_page[$video->idx_groupe_video][$compteur_video] = $video ;

            $compteur_video++;
        }
		
		if ($compteur_video > 0){
			$donnees_groupe_page[$donnees_groupe_video->idx_groupe_video] = $groupe_video;
		}

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="include/swiper/css/swiper.min.css">
        <link rel="stylesheet" href="css/style-adept.css" >
        <title>ADEPT - Videos</title>
    </head>
        
    <body>
      <div class="container fond">
        <header class="row">
            <div class="col-md-12">
                <div id="logo">
                   <img src="images/logo.jpg" alt="Logo d'ADEPT" />    
                </div>
            </div>
        </header>
             
        <div class="row">
            <div class="col-md-2">
                <?php include("menus.php"); ?>
            </div>

            <div class="col-md-10">
                <div class="container">
					<?php if (count($donnees_groupe_page) == 0) : ?>
						<h2><?php echo 'Il n\'y a actuellement pas de vidéos pour ' . $nom_categorie . '.' ?></h2>
					<?php else : ?>
						<?php  foreach($donnees_groupe_page as $dgp ) : ?>
						<div class="row" >
							<h1> <?php echo $dgp->date . ' - ' . $dgp->nom_groupe_video ;  ?></h1>

							<div class="col-md-4 margin-top">
								<p><?php echo $dgp->description ; ?> </p>
							</div>

							<div class="col-md-4 col-md-offset-1 margin-top">
							
								<div class="swiper-container">
									<div class="swiper-wrapper">

									<?php foreach($donnees_groupe_video_page[$dgp->idx_groupe_video] as $dgpp ) : ?>
										<div class="swiper-slide" style="background-image:url(<?php echo  $url_videos . $dgpp->url ; ?>)"></div>
									<?php  endforeach ; ?>
									</div>
									<!-- Add Pagination -->
									<div class="swiper-pagination"></div>
								</div>
									
							</div>

						</div>
						<?php  endforeach ; ?>
					<?php endif ; ?>
                </div>
        	</div>
        </div>
           
        <footer class="row">
        </footer>

       </div>
    </body>

    <script type="text/javascript" src="include/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="include/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="include/swiper/js/jquery.js"></script>
    <script type="text/javascript" src="include/swiper/js/swiper.jquery.min.js"></script>

    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflow: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows : true
        }
    });
    </script>
</html>
