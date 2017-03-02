<?php
    $menu="Photos";
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
      <div class="container">
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


                <div id="carousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
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
            </div>
        </div>
           
        <footer class="row">
        </footer>

       </div>
    </body>

    <script type="text/javascript" src="include/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="include/bootstrap/js/bootstrap.min.js"></script>
</html>
