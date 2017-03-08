
<?php
    $menu="Photos";

    include("include/connexion.php") ;
    include("include/objet/OPhoto.php");
    include("include/objet/OGroupePhotos.php");

    $requete_select = $bdd->prepare('SELECT idx_groupe_photos, nom_groupe_photos, gp.description, date, gp.idx_type_groupe_photos FROM groupe_photos gp
            INNER JOIN type_groupe_photos tgp ON tgp.idx_type_groupe_photos = gp.idx_type_groupe_photos
            WHERE tgp.description=:type ORDER BY date DESC ' );
    $requete_select->execute(array('type' => $type) );

    $donnees_groupe_photos_page = array();
    $donnees_groupe_page = array();

    $donnees_test ;
    while($donnees_groupe_photos = $requete_select->fetch(PDO::FETCH_OBJ))
    {
        $groupe_photo = new OGroupePhotos() ;
        $groupe_photo->idx_groupe_photos = $donnees_groupe_photos->idx_groupe_photos;
        $groupe_photo->date = $donnees_groupe_photos->date;
        $groupe_photo->description = $donnees_groupe_photos->description;
        $groupe_photo->idx_type_groupe_photos = $donnees_groupe_photos->idx_type_groupe_photos;
        $groupe_photo->nom_groupe_photos = $donnees_groupe_photos->nom_groupe_photos;

        $requete_select_photos = $bdd->prepare('SELECT idx_photos_excursions, nom_photos_excursions, description, url, idx_groupe_photos FROM photos_excursions WHERE idx_groupe_photos = :idx_groupe_photos ');

        $requete_select_photos->execute(array('idx_groupe_photos' => $donnees_groupe_photos->idx_groupe_photos));

        $compteur_photo=0;

        while($donnees_photos = $requete_select_photos->fetch(PDO::FETCH_OBJ))
        {
            $photo = new OPhoto();
            $photo->idx_photo = $donnees_photos->idx_photos_excursions;
            $photo->nom = $donnees_photos->nom_photos_excursions;
            $photo->description = $donnees_photos->description;
            $photo->url = $donnees_photos->url ;
            $photo->idx_groupe_photos = $donnees_photos->idx_groupe_photos;

            $donnees_groupe_photos_page[$photo->idx_groupe_photos][$compteur_photo] = $photo ;

            $compteur_photo++;

        }

        if ($compteur_video > 0){
			$donnees_groupe_page[$donnees_groupe_photos->idx_groupe_photos] = $groupe_photo;
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
        <title>ADEPT - Photos</title>
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
                    <?php  foreach($donnees_groupe_page as $dgp ) : ?>
                    <div class="row" >
                        <h1> <?php echo $dgp->date . ' - ' . $dgp->nom_groupe_photos ;  ?></h1>

                        <div class="col-md-4 margin-top">
                            <p><?php echo $dgp->description ; ?> </p>
                        </div>

                        <div class="col-md-4 col-md-offset-1 margin-top">
                        
                            <div class="swiper-container">
                            	<div class="swiper-wrapper">

                                <?php foreach($donnees_groupe_photos_page[$dgp->idx_groupe_photos] as $dgpp ) : ?>
                               		<div class="swiper-slide" style="background-image:url(<?php echo  $url_photos . $dgpp->url ; ?>)"></div>
                                <?php  endforeach ; ?>
                                </div>
                                <!-- Add Pagination -->
								<div class="swiper-pagination"></div>
                            </div>
                                
                        </div>

                    </div>
                    <?php  endforeach ; ?>
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
