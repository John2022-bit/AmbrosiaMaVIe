
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Page insertion - Ambrosia</title>
    
    <!-- SEO Meta-->
    <meta name="description" content="Agence matrimoniale">
    <meta name="keywords" content="mariage, agence matrimoniale, couple mixte, amour">
    <meta name="author" content="Babouk">
    
    <!-- viewport scale-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
            
    <!-- Favicon and Apple Icons    -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">
    <link rel="shortcut icon" href="assets/img/favicon/114x114.png">
    <link rel="apple-touch-icon-precomposed" href="assets/img/favicon/96x96.png">

    
    <!--Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700%7CWork+Sans:400,500">
    
    
    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css">
    
    
    <!-- stylesheet-->    
    <link rel="stylesheet" href="assets/css/vendors.bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
  </head>
  <?php include("InfoContacts.php");?> 
  <body>
  
  <?php
    if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] ==  "6789") // Si le mot de passe est bon
    {
    // On affiche les codes

    include("menu.php");?>
  
  <div class="site-search">
   <div class="site-search__close bg-black-0_8"></div>
   <form class="form-site-search" action="#" method="POST">
    <div class="input-group">
      <input type="text" placeholder="Search" class="form-control py-3 border-white" required="">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit"><i class="ti-search"></i></button>
      </div>
    </div>
   </form> 
  </div> <!-- END site-search-->

   
   
   
  <div class="py-5 bg-cover text-white" data-dark-overlay="5" style="background:url(assets/img/1920/658_2.jpg) no-repeat">
    <div class="container">
     <div class="row align-items-center">
       <div class="col-md-6">
         <h2>Ajout d'une nouvelle vidéo</h2>
       </div>
       <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end bg-transparent">  
          <li class="breadcrumb-item">
            <a href="index.php">Accueil</a>
          </li> 
          <li class="breadcrumb-item">
            <a href="verification.php"> Ajouter un article</a>
          </li>
          <li class="breadcrumb-item">
            Formulaire Ajout
          </li>
        </ol>
       </div>
     </div>
    </div> 
  </div>
  
<section class="pt-5 paddingBottom-150 bg-light-v2">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mt-4">
        
       <div class="card shadow-v5 mt-5 padding-40">
          <h4>
            Nouvelle vidéo TVsat Ambrosia
          </h4>

          <form action="insertionVideo.php" method="POST" enctype="multipart/form-data">
            <div class="row mt-4">
              <div class="col-md-6 mb-4">
                <input type="text" class="form-control" name="titre" placeholder="Titre">
              </div>
            </div>
			<div class="row mt-4">
              <div class="col-md-6 mb-4">
                <input type="text" class="form-control" name="categorie" placeholder="Catégorie de la vidéo">
              </div>
            </div>
            <textarea class="form-control mb-4" rows="5" name="commentaire" placeholder="Description de la vidéo"></textarea>
			
            <p>Choisissez une vidéo avec une taille inférieure à 2 Mo.</p>
			 <input type="file" name="photo">
			<button class="btn btn-primary" type="submit" name="ok">Envoyez</button>
          </form>
       </div>
        
      </div> <!-- END col-lg-9 -->
      
      <aside class="col-lg-3 mt-4">  
              
      <div class="widget">
         <h2 class="widget-title">
           Connect & Follow
         </h2>
          <a href="#" class="btn btn-light iconbox hover:bg-primary text-gray m-1">
            <i class="ti-facebook"></i>
          </a>
          <a href="#" class="btn btn-light iconbox hover:bg-primary text-gray m-1">
            <i class="ti-twitter"></i>
          </a>
          <a href="#" class="btn btn-light iconbox hover:bg-primary text-gray m-1">
            <i class="ti-linkedin"></i>
          </a>
          <a href="#" class="btn btn-light iconbox hover:bg-primary text-gray m-1">
            <i class="ti-google"></i>
          </a>
          <a href="#" class="btn btn-light iconbox hover:bg-primary text-gray m-1">
            <i class="ti-pinterest"></i>
          </a>
          <a href="#" class="btn btn-light iconbox hover:bg-primary text-gray m-1">
            <i class="ti-instagram"></i>
          </a>
       </div> <!-- END widget--> 
       
      </aside> <!-- END col-lg-3 -->
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>  <!-- END section -->

 <?php include("footer.php"); ?>

<div class="scroll-top">
  <i class="ti-angle-up"></i>
</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
	<?php
    }
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Mot de passe incorrect</p>';
    }
    ?>
  </body>
</html>
