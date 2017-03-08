<?php
    $menu="Vidéos";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style-adept.css" >
        <title>ADEPT - Vidéos</title>
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

            <div class="col-md-10 text-center margin-top">
                <h1>Vidéos</h1>
                <!-- Pour la spéléo-->
                <div class="col-md-4">
                    <a href="videos-speleologie.php">
                        <img alt="Acces photos spéléologie" src="photos/photo_speleologie.jpg">
                        <div class="lien-photos">
                            Spéléologie
                        </div>
                    </a>
                </div>


                <!-- Pour la randonnée-->
                <div class="col-md-4">
                    <a href="videos-randonnee.php">
                        <img alt="Acces photos randonnée" src="photos/photo_randonnee.jpg">
                        <div class="lien-photos">
                            Randonnée
                        </div>
                    </a>
                </div>



                <!-- Pour le VTT-->
                <div class="col-md-4">
                    <a href="videos-vtt.php">
                        <img alt="Acces photos VTT" src="photos/photo_vtt.jpg">
                        <div class="lien-photos">
                            VTT
                        </div>
                    </a>
                </div>
            </div>

        </div>
           
        <footer class="row">
        </footer>

       </div>
    </body>

    <script type="text/javascript" src="include/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="include/bootstrap/js/bootstrap.min.js"></script>
</html>
