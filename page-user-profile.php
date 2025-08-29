<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$utilisateur_id = (int) $_SESSION['id'];
	
	if(empty($utilisateur_id)){
		header('Location: /index.php');
		exit;	
	}
	
	
	$req = $BDD->prepare("SELECT u.*, p.nom_fr_fr
		FROM utilisateur u
		INNER JOIN pays p ON p.code = u.pays
		WHERE u.id = ?");
		
	$req->execute(array($utilisateur_id));
		
	$voir_utilisateur = $req->fetch();
	
	if(!isset($voir_utilisateur['id'])){
		header('Location: /membres.php');
		exit;	
	}
	
	function age($date){
		$age = date('Y') - date('Y', strtotime($date));
		
		if(date('md') < date('md', strtotime($date))){
			return $age - 1;
		}
		return $age;
	}
	
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Page utilisateur Ambrosia</title>
    
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

  <section class="paddingTop-50 paddingBottom-120 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mt-4">
          <div class="card shadow-v1">
            <div class="card-header text-center border-bottom pt-5 mb-4">
             <img class="rounded-circle mb-4" src="img/user_photo/<?= $voir_utilisateur['photo'] ?>" width="200" height="200" alt="">
             <h4>
               <?= $voir_utilisateur['nom_user'] ?>
             </h4>
              <p>
                <?= $voir_utilisateur['profession'] ?>
              </p>
            </div>
            <div class="card-body border-bottom">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <span class="d-block">Adresse mail:</span>
                  <a class="h6" href="mailto:<?= $voir_utilisateur['mail'] ?>"><?= $voir_utilisateur['mail'] ?></a>
                </li>
                <li class="mb-3">
                  <span class="d-block">Téléphone:</span>
                  <a class="h6"><?= $voir_utilisateur['telephone'] ?></a>
                </li>
                <li class="mb-3">
                  <span class="d-block">Adresse:</span>
                  <a class="h6"><?= $voir_utilisateur['ville'] ?> <?= $voir_utilisateur['pays'] ?></a>
                </li>
              </ul>
            </div>
            <div class="card-footer">
             <p>
               Social Profile:
             </p>
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <a href="#" class="btn btn-outline-facebook iconbox iconbox-sm">
                    <i class="ti-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn btn-outline-twitter iconbox iconbox-sm">
                    <i class="ti-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn btn-outline-google-plus iconbox iconbox-sm">
                    <i class="ti-google"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn btn-outline-linkedin iconbox iconbox-sm">
                    <i class="ti-linkedin"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div> <!-- END col-md-4 -->
        <div class="col-lg-8 mt-4">
          <div class="card shadow-v1 padding-30">
            <ul class="nav tab-line tab-line border-bottom mb-4" role="tablist">
             <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#Tabs_1-1" role="tab" aria-selected="true">
                About
              </a>
             </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Tabs_1-2" role="tab" aria-selected="true">
                Courses
              </a>
             </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Tabs_1-3" role="tab" aria-selected="true">
                Reviews
              </a>
             </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Tabs_1-4" role="tab" aria-selected="true">
                Message
              </a>
             </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Tabs_1-5" role="tab" aria-selected="true">
                Settings
              </a>
             </li>
           </ul>
           
            <div class="tab-content">
              <div class="tab-pane fade show active" id="Tabs_1-1" role="tabpanel">
               <h4>
                 Biography
               </h4>
               <p>
                  Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was
                  claritas kesty conctetur kedadip sicing. Dummy text of the printing and typesetting 
                  industry. It was popularised in the 1960s with the release of Letraset sheets contain luing lorem Ipsum passages, and more recently with desktop publishing.
               </p>
                <p>
                  Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius claritas est conctetur adip sicing. Dummy text of the printing was and typesetting industry. Lorem Ipsum has been the industry standad dummy text ever since the 1500s.
                </p>
                
                <hr class="my-4">
                <div class="border-bottom mb-4 pb-4">
                 <h4 class="mb-4">
                   Experience
                 </h4>
                  <ul class="ec-timeline-portlet list-unstyled bullet-line-list">
                    <li class="ec-timeline-portlet__item mb-4">
                      <small>2000-2004</small>
                      <h6 class="mb-0">Full Stack Developer</h6>
                      <p class="mb-2">Apple Inc.</p>
                      <p>
                        Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty conctetur they kedadip lectores legee sicing. legee lrus quodk legunt.
                      </p>
                    </li>
                    <li class="ec-timeline-portlet__item">
                      <small>2004-2018</small>
                      <h6 class="mb-0">Project Manager</h6>
                      <p class="mb-2">Google</p>
                      <p>
                        Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty conctetur they kedadip lectores legee sicing. legee lrus quodk legunt.
                      </p>
                    </li>
                  </ul>
                </div>
                <div class="mb-4">
                 <h4 class="mb-4">
                   Education
                 </h4>
                  <ul class="ec-timeline-portlet list-unstyled bullet-line-list">
                    <li class="ec-timeline-portlet__item mb-4">
                      <small>2000-2004</small>
                      <h6 class="mb-0">Full Stack Developer</h6>
                      <p class="mb-2">Apple Inc.</p>
                      <p>
                        Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty conctetur they kedadip lectores legee sicing. legee lrus quodk legunt.
                      </p>
                    </li>
                    <li class="ec-timeline-portlet__item">
                      <small>2004-2018</small>
                      <h6 class="mb-0">Project Manager</h6>
                      <p class="mb-2">Google</p>
                      <p>
                        Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty conctetur they kedadip lectores legee sicing. legee lrus quodk legunt.
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="tab-pane fade" id="Tabs_1-2" role="tabpanel">
                <div class="row">
                  <div class="col-md-6 mt-4">
                    <a href="page-course-details.html" class="card text-gray overflow-hidden height-100p shadow-v1 border">
                     <span class="ribbon-badge font-size-sm bg-success text-white">Best selling</span>
                      <img class="card-img-top" src="assets/img/360x220/1.jpg" alt="">
                      <div class="card-body">
                        <h4 class="h5">
                          The Web Developer Bootcamp
                        </h4>
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
                        <h4 class="h5">
                          <span class="text-primary">$180</span>
                        </h4>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-6 mt-4">
                    <a href="page-course-details.html" class="card text-gray overflow-hidden height-100p shadow-v1 border">            
                      <img class="card-img-top" src="assets/img/360x220/2.jpg" alt="">
                      <div class="card-body">
                        <h4 class="h5">
                          C++ Essential Training
                        </h4>
                        <p class="my-3">
                          <i class="ti-user mr-2"></i>
                          Andrew Mead, John Doe
                        </p>
                        <p class="mb-0">
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star-half"></i>
                          <span class="text-dark">4.9</span>
                          <span>(8793)</span>
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
                          <span class="text-primary d-block">$10</span>
                          <s class="small">$129</s>
                        </h4>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-6 mt-4">
                    <a href="page-course-details.html" class="card text-gray overflow-hidden height-100p shadow-v1 border">
                      <img class="card-img-top" src="assets/img/360x220/3.jpg" alt="">
                      <div class="card-body">
                        <h4 class="h5">
                          Programming Real-World Examples
                        </h4>
                        <p class="my-3">
                          <i class="ti-user mr-2"></i>
                          Adam Kury
                        </p>
                        <p class="mb-0">
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <span class="text-dark">3.4</span>
                          <span>(7)</span>
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
                        <h4 class="h5">
                          <span class="text-primary">$249</span>
                        </h4>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-6 mt-4">
                    <a href="page-course-details.html" class="card text-gray overflow-hidden height-100p shadow-v1 border shadow-v1">
                      <img class="card-img-top" src="assets/img/360x220/4.jpg" alt="">
                      <div class="card-body">
                        <h4 class="h5">
                          Java 8 Essential Training
                        </h4>
                        <p class="my-3">
                          <i class="ti-user mr-2"></i>
                          Anthony Brooks
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
                        <h4 class="h5">
                          <span class="text-success">Free</span>
                        </h4>
                      </div>
                    </a>
                  </div>
                  <div class="col-12 text-center mt-5">
                    <a href="#" class="btn btn-icon btn-outline-primary">
                      <i class="ti-reload mr-2"></i>
                      Load More
                    </a>
                  </div> 
                </div> <!-- END row-->
              </div> <!-- END tab-pane -->
              <div class="tab-pane fade" id="Tabs_1-3" role="tabpanel">
                <div class="row mx-0 py-4 border-bottom mt-4">
                  <div class="col-md-4 media">
                    <img class="iconbox iconbox-xl" src="assets/img/avatar/4.jpg" alt="">
                    <div class="media-body ml-4 mb-4 mb-md-0">
                     <small class="text-gray">7 min ago</small>
                     <h6>
                       Anthony Forsey
                     </h6>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <p>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                    </p>
                    <p class="font-size-18">
                      Awesome course
                    </p>
                    <p>
                      Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty they conctetur they kedadip lectores legee sicing.
                    </p>
                  </div>
                </div> <!-- END d-flex-->

                <div class="row mx-0 py-4 border-bottom mt-4">
                  <div class="col-md-4 media">
                    <img class="iconbox iconbox-xl" src="assets/img/avatar/5.jpg" alt="">
                    <div class="media-body ml-4 mb-4 mb-md-0">
                     <small class="text-gray">1 mon ago</small>
                     <h6>
                       Justin Nam
                     </h6>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <p class="text-light">
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </p>
                    <p class="font-size-18">
                      Test review lol
                    </p>
                    <p>
                      Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty.
                    </p>
                  </div>
                </div> <!-- END d-flex-->

                <div class="row mx-0 py-4 border-bottom mt-4">
                  <div class="col-md-4 media">
                    <div class="iconbox iconbox-xl border">
                      MD
                    </div>
                    <div class="media-body ml-4 mb-4 mb-md-0">
                     <small class="text-gray">3 Mon ago</small>
                     <h6>
                       Murir Dokan
                     </h6>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <p>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                    </p>
                    <p class="font-size-18">
                      This is a title of review. the developer suffer from lot's of vitamin. what about you?
                    </p>
                    <p>
                      Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty they conctetur they kedadip lectores legee sicing.
                    </p>
                  </div>
                </div> <!-- END d-flex-->


                <div class="row mx-0 py-4 border-bottom mt-4">
                  <div class="col-md-4 media">
                    <img class="iconbox iconbox-xl" src="assets/img/avatar/6.jpg" alt="">
                    <div class="media-body ml-4 mb-4 mb-md-0">
                     <small class="text-gray">1 year ago</small>
                     <h6>
                       John Doe
                     </h6>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <p>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                      <i class="fas fa-star text-warning"></i>
                    </p>
                    <p class="font-size-18">
                      Best course ever
                    </p>
                    <p>
                      Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty they conctetur they kedadip lectores legee sicing.
                      Investig ationes demons travge vunt lectores legee lrus quodk legunt saepius was claritas kesty they conctetur they kedadip lectores legee sicing.
                    </p>
                  </div>
                </div> <!-- END d-flex-->
                <div class="text-center mt-5">
                  <a href="#" class="btn btn-primary btn-icon">
                    <i class="ti-reload mr-2"></i>
                    Load More
                  </a>
                </div>
              </div>
              <div class="tab-pane fade" id="Tabs_1-4" role="tabpanel">
                <form action="#" method="POST" class="p-4">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <input type="text" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="col-md-6 mb-4">
                      <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-12 mb-4">
                      <textarea class="form-control" placeholder="Message" rows="5" required></textarea>
                    </div>
                    <div class="col-12 mb-4">
                      <button class="btn btn-primary">Send Now</button>
                    </div>
                  </div>
                </form>
              </div>
              
              <div class="tab-pane fade" id="Tabs_1-5" role="tabpanel">
                 <div class="border-bottom mb-4 pb-4">
                   <h4>
                     Upload Avatar
                   </h4>
                   <div class="media align-items-end mt-4">
                    <div class="position-relative">
                      <input type="file" class="opacity-0 position-absolute as-parent">
                      <img src="assets/img/placeholder-1.jpg" alt="">
                    </div>
                     <div class="media-body ml-4 mb-4 mb-md-0">
                       <p>
                         JPG or PNG 200x200 px
                       </p>
                       <a href=""></a>
                       <button class="btn btn-outline-primary">
                         <input type="file" class="opacity-0 position-absolute">
                         Upload
                       </button>

                     </div>
                   </div>
                 </div>
                 
                 <div class="border-bottom mb-4 pb-4">
                   <h4 class="mb-4">
                     Manage your Account
                   </h4>
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Full Name</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="John Doe">
                    </div>
                  </div>
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Position</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="Web Developer and Instructor">
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Email</label>
                    <div class="col-md-9">
                      <input type="email" class="form-control" value="support@echotheme.com">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Phone</label>
                    <div class="col-md-9">
                      <input type="tel" class="form-control" value="+91 654 784 547">
                    </div>
                  </div> 
                  
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Location</label>
                    <div class="col-md-9">
                      <input type="tel" class="form-control" value="South Street, London, UK">
                    </div>
                  </div>  
                  
                 </div>  
                 
                 <div class="border-bottom mb-4 pb-4">
                   <h4 class="mb-4">
                     Security Settings
                   </h4>
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Current Password</label>
                    <div class="col-md-9">
                      <input type="password" class="form-control" value="123456">
                    </div>
                  </div>
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">New Password</label>
                    <div class="col-md-9">
                      <input type="password" class="form-control" placeholder="12345678">
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Confirm Password</label>
                    <div class="col-md-9">
                      <input type="password" class="form-control" placeholder="12345678">
                    </div>
                  </div> 
                 </div>  
                 
                 <div class="border-bottom mb-4 pb-4">
                   <h4 class="mb-4">
                     Social Account
                   </h4>
                   
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Facebook</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="https://fb.com/jaman57">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Twitter</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="https://Twitter.com/jaman57">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Linkdin</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="https://Linkdin.com/jaman57">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-dark">Google</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="https://Google.com/jaman57">
                    </div>
                  </div>

                 </div> 
                 
                 <div class="border-bottom mb-4 pb-4">
                   <h4 class="mb-4">
                     About You
                   </h4>
                   <textarea rows="6" class="form-control">Dummy text of the printing and typesetting industry. It was popular ised in the kest with the release of Letraset sheets contain was luing lorem kepsum passages, and more recently with desktop publishing software.
                   </textarea>
                 </div>
                 
                 <div class="border-bottom mb-4 pb-4">
                   <h4 class="mb-4">
                     Account Type
                   </h4>
                   <p>
                     <span class="badge badge-danger">Free</span>
                   </p>
                 </div>
                 <div class="my-5">
                   <button class="btn btn-success m-2">Update Profile</button>
                   <button class="btn btn-danger m-2">Cancel</button>
                 </div>             
              </div> <!-- END tab-pane -->
            </div> <!-- END tab-content-->
          </div> <!-- END card-->
        </div> <!-- END col-md-8 -->
      </div> <!--END row-->
    </div> <!--END container-->
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