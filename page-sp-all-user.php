<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	
	if(isset($_SESSION['id'])){
		$afficher_membres = $BDD->prepare("SELECT *
			FROM utilisateur
			WHERE id <> ?");
			
		$afficher_membres->execute(array($_SESSION['id']));		
		
	}else{
		$afficher_membres = $BDD->prepare("SELECT *
			FROM utilisateur");
			
		$afficher_membres->execute();
	}	
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Ambrosia</title>
    
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
  <?php include("InfoContacts-deconnexion.php");?> 
  <body>
   <?php include("menu.php");?> 
   
<div class="padding-y-60 bg-cover" data-dark-overlay="6" style="background:url(assets/img/breadcrumb-bg.jpg) no-repeat">
  <div class="container">
   <div class="row align-items-center">
     <div class="col-lg-6 my-2 text-white">
      <ol class="breadcrumb breadcrumb-double-angle bg-transparent p-0">  
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Courses</a></li>
        <li class="breadcrumb-item">All Courses</li>
      </ol>
      <h2 class="h1">
        All Courses Gird
      </h2>
      <p class="lead">
        <span class="text-primary">6,178</span> courses found
      </p>
     </div>
      <form class="col-lg-5 my-2 ml-auto">
        <div class="input-group bg-white rounded p-1">
          <input type="text" class="form-control border-white" placeholder="What do you want to learn?" required="">
          <div class="input-group-append">
            <button class="btn btn-info rounded" type="submit">
              Search
              <i class="ti-angle-right small"></i>
            </button>
          </div>
        </div>
      </form>
   </div>
  </div>
</div>

<section class="py-3 position-relative shadow-v1">
  <div class="container">
    <form class="row">
      <div class="col-md-6 my-2">
        <ul class="list-inline">
          <li class="list-inline-item my-2">
            <select class="form-control">
              <option selected>Select Category</option>
              <option>UI/UX design</option>
              <option>Web app</option>
              <option>React</option>
              <option>Game development</option>
            </select>
          </li>
          <li class="list-inline-item my-2">
            <select class="form-control">
              <option selected>Filter</option>
              <option>Best selling</option>
              <option>Newest</option>
              <option>Top rated</option>
              <option>Low price</option>
              <option>High price</option>
            </select>
          </li>
        </ul>
      </div>
      <div class="col-md-6 my-2 text-md-right">
       <div class="d-inline-flex justify-md-content-end">
        <select class="form-control my-2">
          <option selected default>items per page</option>
          <option>8</option>
          <option>12</option>
          <option>16</option>
          <option>20</option>
          <option>24</option>
        </select> 
        <div class="d-flex rounded border ml-3 px-2 my-2">
          <a href="page-sp-all-courcess.html" class="active btn px-1"><ti class="ti-layout-grid2"></ti></a>
          <a href="page-sp-all-courcess-list.html" class="btn px-1"><ti class="ti-view-list"></ti></a>
        </div>
       </div>
      </div>
    </form> <!-- END row-->
  </div> <!-- END container-->
</section>

<section class="padding-y-60 bg-light-v2">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/1.jpg" alt="">
          <div class="card-body">
           <span class="badge position-absolute top-0 bg-success text-white" data-offset-top="-13">
             Best selling
           </span>
            <a href="#" class="h5">
              The Web Developer Bootcamp
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Andrew Mead
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$180</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/2.jpg" alt="">
          <div class="card-body">
           <span class="badge position-absolute top-0 bg-danger text-white" data-offset-top="-13">
             Trending
           </span>
            <a href="#" class="h5">
              Visual Basic Essential Training For Begainers
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Andrew Mead, John Doe
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$10</span>
              <span class="d-block text-gray"><s>$129</s></span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/3.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              Programming Real-World Examples
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Anthony Broks
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$375</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/4.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              Programming Real-World Examples
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Asif vai
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$180</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/5.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              Java 8 Essential Training
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Jonathon
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$249</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/6.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              C++ Essential Training
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Jonathon
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-success font-weight-bold">Free</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/1.jpg" alt="">
          <div class="card-body">
           <span class="badge position-absolute top-0 bg-success text-white" data-offset-top="-13">
             Best selling
           </span>
            <a href="#" class="h5">
              The Web Developer Bootcamp
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Andrew Mead
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$180</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/2.jpg" alt="">
          <div class="card-body">
           <span class="badge position-absolute top-0 bg-danger text-white" data-offset-top="-13">
             Trending
           </span>
            <a href="#" class="h5">
              Visual Basic Essential Training For Begainers
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Andrew Mead, John Doe
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$10</span>
              <span class="d-block text-gray"><s>$129</s></span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/3.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              Programming Real-World Examples
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Anthony Broks
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$375</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/4.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              Programming Real-World Examples
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Asif vai
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$180</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/5.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              Java 8 Essential Training
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Jonathon
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-primary">$249</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 marginTop-30">
        <div href="page-course-details.html" class="card height-100p text-gray shadow-v1">
          <img class="card-img-top" src="assets/img/360x220/6.jpg" alt="">
          <div class="card-body">
            <a href="#" class="h5">
              C++ Essential Training
            </a>
            <p class="my-3">
              <i class="ti-user mr-2"></i>
              Jonathon
            </p>
            <p class="mb-0">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <span class="text-dark">5</span>
              <span>(4578)</span>
            </p>
          </div>
          <div class="card-footer media align-items-center justify-content-between">
            <ul class="list-unstyled mb-0">
              <li class="mb-1">
                <i class="ti-headphone small mr-2"></i>
                46 lectures
              </li>
              <li class="mb-1">
                <i class="ti-time small mr-2"></i>
                27.5 hours
              </li>
            </ul>
            <h4 class="h5 text-right">
              <span class="text-success font-weight-bold">Free</span>
            </h4>
          </div>
        </div>
      </div>
      
      <div class="col-12 marginTop-70">
        <ul class="pagination pagination-primary justify-content-center">
          <li class="page-item mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">
              <i class="ti-angle-left small"></i>
            </a>
          </li>
          <li class="page-item mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">1</a>
          </li>
          <li class="page-item active disabled mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">2</a>
          </li>
          <li class="page-item mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">3</a>
          </li>
          <li class="page-item disabled mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">
              <i class="ti-more-alt"></i>
            </a>
          </li>
          <li class="page-item mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">16</a>
          </li>
          <li class="page-item mx-1">
            <a class="page-link iconbox iconbox-sm rounded-0" href="#">
              <i class="ti-angle-right small"></i>
            </a>
          </li>
        </ul>
      </div>
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>
   
   
   
   
   
   
<footer class="site-footer">
  <div class="footer-top bg-dark text-white-0_6 pt-5 paddingBottom-100">
    <div class="container"> 
      <div class="row">

        <div class="col-lg-3 col-md-6 mt-5">
         <img src="assets/img/logo-white.png" alt="Logo">
         <div class="margin-y-40">
           <p>
            Nunc placerat mi id nisi interdm they mtolis. Praesient is haretra justo ught scel erisque placer.
          </p>
         </div>
          <ul class="list-inline"> 
            <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href=""><i class="ti-facebook"> </i></a></li>
            <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href=""><i class="ti-twitter"> </i></a></li>
            <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href=""><i class="ti-linkedin"> </i></a></li>
            <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href=""><i class="ti-pinterest"></i></a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 mt-5">
          <h4 class="h5 text-white">Contact Us</h4>
          <div class="width-3rem bg-primary height-3 mt-3"></div>
          <ul class="list-unstyled marginTop-40">
            <li class="mb-3"><i class="ti-headphone mr-3"></i><a href="tel:+8801740411513">800 567.890.576 </a></li>
            <li class="mb-3"><i class="ti-email mr-3"></i><a href="mailto:support@educati.com">support@educati.com</a></li>
            <li class="mb-3">
             <div class="media">
              <i class="ti-location-pin mt-2 mr-3"></i>
              <div class="media-body">
                <span> 184 Main Collins Street Chicago, United States</span>
              </div>
             </div>
            </li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 mt-5">
          <h4 class="h5 text-white">Quick links</h4>
          <div class="width-3rem bg-primary height-3 mt-3"></div>
          <ul class="list-unstyled marginTop-40">
            <li class="mb-2"><a href="page-about.html">About Us</a></li>
            <li class="mb-2"><a href="page-contact.html">Contact Us</a></li>
            <li class="mb-2"><a href="page-sp-student-profile.html">Students</a></li>
            <li class="mb-2"><a href="page-sp-admission-apply.html">Admission</a></li>
            <li class="mb-2"><a href="page-events.html">Events</a></li>
            <li class="mb-2"><a href="blog-card.html">Latest News</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 mt-5">
          <h4 class="h5 text-white">Newslatter</h4>
          <div class="width-3rem bg-primary height-3 mt-3"></div>
          <div class="marginTop-40">
            <p class="mb-4">Subscribe to get update and information. Don't worry, we won't send spam!</p>
            <form class="marginTop-30" action="#" method="POST">
              <div class="input-group">
                <input type="text" placeholder="Enter your email" class="form-control py-3 border-white" required="">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">Subscribe</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        
      </div> <!-- END row-->
    </div> <!-- END container-->
  </div> <!-- END footer-top-->

  <div class="footer-bottom bg-black-0_9 py-5 text-center">
    <div class="container">
      <p class="text-white-0_5 mb-0">&copy; 2018 Educati. All rights reserved. Created by <a href="http://echotheme.com" target="_blunk">EchoTheme</a></p>
    </div>
  </div>  <!-- END footer-bottom-->
</footer> <!-- END site-footer -->


<div class="scroll-top">
  <i class="ti-angle-up"></i>
</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>