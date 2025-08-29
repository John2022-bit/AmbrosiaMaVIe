<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>validation</title>
    
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
   

  <?php include("menu.php");?>

<div class="padding-y-60 bg-cover" data-dark-overlay="6" style="background:url(img/coeur1.png) no-repeat">
  <div class="container">
   <div class="row align-items-center">
     <div class="col-lg-6 my-2 text-white">
      <ol class="breadcrumb breadcrumb-double-angle bg-transparent p-0">  
        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
        <li class="breadcrumb-item"><a href="blog-list.php">Tous les articles</a></li>
        <li class="breadcrumb-item">Connexion</li>
      </ol>
      <h2 class="h1">
        Connectez vous
      </h2>
     </div>
      <form class="col-lg-5 my-2 ml-auto" action="formulaireAjout.php" method="POST">
        <div class="input-group bg-white rounded p-1">
          <input type="password" class="form-control border-white" name="mot_de_passe" placeholder="Entrer le mot de passe" required="">
          <div class="input-group-append">
            <button class="btn btn-info rounded" type="submit">
              Ouvrir
              <i class="ti-angle-right small"></i>
            </button>
          </div>
        </div>
      </form>
   </div>
  </div>
</div>
   
<?php include("footer.php"); ?>

<div class="scroll-top">
  <i class="ti-angle-up"></i>
</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>