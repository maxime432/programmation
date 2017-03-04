<?php
    $type="Spéléologie";

?>

<?php
    $menu="Photos";

    include("include/connexion.php") ;
    include("include/objet/OPhoto.php");
    include("include/objet/OGroupePhotos.php");

    $requete_select = $bdd->prepare('SELECT idx_groupe_photos, nom_groupe_photos, gp.description, date, gp.idx_type_groupe_photos FROM groupe_photos gp
            INNER JOIN type_groupe_photos tgp ON tgp.idx_type_groupe_photos = gp.idx_type_groupe_photos
            WHERE tgp.description=:type' );
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

        $donnees_groupe_page[$donnees_groupe_photos->idx_groupe_photos] = $groupe_photo;

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

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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


            <div class="col-md-4 col-md-offset-5 margin-top">

                <?php  foreach ($donnees_groupe_page as $dgp) : ?>

                <div id="carousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php  foreach ($donnees_groupe_photos_page as $dgpp) : ?>
                        <div class="item"> <img alt=<?php echo $dgpp->description; ?>  src= <?php echo "photos/speleologie/" . $dgpp->url; ?> ></div>
                    <?php  endforeach ?>
                    <div class="item active"> <img alt="" src="photos/speleologie/groupe_1_photo_1.JPG"></div>
                    <div class="item"> <img alt="" src="photos/speleologie/groupe_1_photo_2.JPG"></div>
                    <div class="item"> <img alt="" src="photos/speleologie/groupe_1_photo_3.JPG"></div>
                    <div class="item"> <img alt="" src="photos/speleologie/groupe_1_photo_4.JPG"></div>
                    <div class="item"> <img alt="" src="photos/speleologie/groupe_1_photo_5.JPG"></div>
                  </div>
                  <a class="left carousel-control" href="#carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
                </div>

                <?php  endforeach ?>
            </div>
        </div>

        <pre><?php print_r($donnees_groupe_page); ?></pre>
        <pre><?php print_r($donnees_groupe_photos_page) ; ?></pre>
           
        <footer class="row">
        </footer>

       </div>
    </body>

    <script type="text/javascript" src="include/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="include/bootstrap/js/bootstrap.min.js"></script>
</html>
