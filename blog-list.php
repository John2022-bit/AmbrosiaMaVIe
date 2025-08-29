<!DOCTYPE html> 
   <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Tous les articles - Ambrosia</title>
    
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
	
	  <div class="py-5 bg-cover text-white" data-dark-overlay="5" style="background:url(img/coeur.png) no-repeat">
		<div class="container">
		 <div class="row align-items-center">
		   <div class="col-md-6">
			 <h2>Les publications Ambrosia Rose</h2>
		   </div>
		   <div class="col-md-6">
			<ol class="breadcrumb justify-content-md-end bg-transparent">  
			  <li class="breadcrumb-item">
				<a href="#">Accueil</a>
			  </li> 
			  <li class="breadcrumb-item">
				<a href="verification.php"> Ajouter un article</a>
			  </li>
			  <li class="breadcrumb-item">
				Tous les articles
			  </li>
			</ol>
		   </div>
		 </div>
		</div> 
	  </div>
  			   
	<section class="pt-5 paddingBottom-100 bg-light-v2">
     <div class="container">
       <div class="row">
        <?php 
			   $connect = mysqli_connect("localhost", "cp1088772p18_ambrosiarose", "Champagne-1977", "cp1088772p18_ambrosiarose"); 
			 
			   /* Vérification de la connexion */ 
			   if (!$connect) { 
				  echo "Échec de la connexion : ".mysqli_connect_error(); 
				  exit(); 
			   } 
			 
			   $requete = "SELECT * FROM Article ORDER BY Date DESC"; 
			   if ($resultat = mysqli_query($connect,$requete)) { 
				  date_default_timezone_set('Europe/Paris'); 
				  /* fetch le tableau associatif */ 
				  while ($ligne = mysqli_fetch_assoc($resultat)) { 
					 $dt_debut = date_create_from_format('Y-m-d H:i:s', $ligne['Date']); 
		?>
         <div class="col-lg-4 col-md-6 marginTop-30">
          <article class="card">
           <div class="card-img">
           <?php if ($ligne['Photo'] != "") {?>
				<img class="rounded w-100" src="img/articles_photo/<?php echo $ligne['Photo']; ?>" alt="">
			<?php } ?>             
           </div>
            <div class="card-body px-0">
              <a href="#" class="h6 my-3">
			     <a href="blog-single.php?Id=<?= $ligne['Id']; ?>"><h4><?php echo $ligne['Titre']; ?></h4></a>
               </a>
              <p>
                Réf:<?php echo $ligne['Id']; ?> Le <?php echo $dt_debut->format('d/m/Y H:i:s'); ?> <br> par <a class="text-primary" href="#">Ducroux</a>
              </p>
            </div>
           </article>
         </div>
			
			<?php
					 } 
				  }  
			   ?> 			
			   
			</div>
		</div>
	</section>
	 <?php include("footer.php"); ?>
</body> 
</html>