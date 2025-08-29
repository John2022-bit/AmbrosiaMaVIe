 <nav class="ec-nav sticky-top bg-white">
  <div class="container">
    <div class="navbar p-0 navbar-expand-lg">
      <div class="navbar-brand">
        <a class="logo-default" href="index.php"><img alt="" src="img/Logo_Ambr.png"></a>
      </div>
      <span aria-expanded="false" class="navbar-toggler ml-auto collapsed" data-target="#ec-nav__collapsible" data-toggle="collapse">
        <div class="hamburger hamburger--spin js-hamburger">
          <div class="hamburger-box">
            <div class="hamburger-inner"></div>
          </div>
        </div>
      </span>
      <div class="collapse navbar-collapse when-collapsed" id="ec-nav__collapsible">
        <ul class="nav navbar-nav ec-nav__navbar ml-auto">		
			
			<a class="nav-link dropdown-toggle no-caret" href="#" data-toggle="dropdown"><i class="ti-home"></i></a>
			<li class="nav-item nav-item__has-dropdown">
            <a class="nav-link dropdown-toggle no-caret" href="#" data-toggle="dropdown"><i class="ti-video-clapper"></i></a>
            <ul class="dropdown-menu dropdown-cart" aria-labelledby="navbarDropdown">
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/2.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Quick intro to Python</a>
                    <span class="text-primary">$199.00</span>
                  </div>
                </div>
              </li>
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/4.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Gentel intro to C++</a>
                    <span class="text-primary">$45.00</span>
                  </div>
                </div>
              </li>
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/3.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Programming 101</a>
                    <span class="text-primary">$79.00</span>
                  </div>
                </div>
              </li>
            </ul>
          </li>
<!--			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Evénements</a>
                <ul class="dropdown-menu">
                  <li><a href="page-events.html" class="nav-link__list">Consultez le programme</a></li>
				  <li><a href="Archives-Evenements.html" class="nav-link__list">Revoir nos événements</a></li>
                </ul>
            </li>
-->						
		<li class="nav-item nav-item__has-dropdown">
            <a class="nav-link dropdown-toggle no-caret" href="#" data-toggle="dropdown"><i class="ti-help"></i></a>
            <ul class="dropdown-menu dropdown-cart" aria-labelledby="navbarDropdown">
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/2.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Quick intro to Python</a>
                    <span class="text-primary">$199.00</span>
                  </div>
                </div>
              </li>
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/4.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Gentel intro to C++</a>
                    <span class="text-primary">$45.00</span>
                  </div>
                </div>
              </li>
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/3.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Programming 101</a>
                    <span class="text-primary">$79.00</span>
                  </div>
                </div>
              </li>
            </ul>
          </li>
		  <li class="nav-item nav-item__has-dropdown">
            <a class="nav-link dropdown-toggle no-caret" href="#" data-toggle="dropdown"><i class="ti-shopping-cart"></i></a>
            <ul class="dropdown-menu dropdown-cart" aria-labelledby="navbarDropdown">
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/2.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Quick intro to Python</a>
                    <span class="text-primary">$199.00</span>
                  </div>
                </div>
              </li>
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/4.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Gentel intro to C++</a>
                    <span class="text-primary">$45.00</span>
                  </div>
                </div>
              </li>
              <li class="dropdown-cart__item">
                <div class="media">
                  <img class="dropdown-cart__img" src="assets/img/shop/products/3.jpg" alt="">
                  <div class="media-body pl-3">
                    <a href="#" class="h6">Programming 101</a>
                    <span class="text-primary">$79.00</span>
                  </div>
                </div>
                <a href="#" class="dropdown-cart__item-remove">
                  <i class="ti-close"></i>
                </a>
              </li>
              <li class="px-2 py-4 text-center">
                Subtotal: <span class="text-primary font-weight-semiBold"> $275.00</span>
              </li>
              <li class="px-2 pb-4 text-center">
                <button class="btn btn-outline-primary mx-1">View Cart</button>
                <button class="btn btn-primary mx-1">Checkout</button>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a class="nav-link site-search-toggler" href="#">
              <i class="ti-search"></i>
            </a>
          </li>
		  
		  <li class="nav-item nav-item__has-dropdown">
                <a href=""><img class="iconbox iconbox-lg mr-2" src="img/user_photo/<?= $voir_utilisateur['photo'] ?>" alt=""></a>
                <ul class="dropdown-menu">
                  <li><a href="profil.php" class="nav-link__list">Voir mon profil</a></li>
				  <li><a href="editer-profil.php" class="nav-link__list">Photo de profil</a></li>
				  <li><a href="editer.php" class="nav-link__list">Editer mon profil</a></li>
				  <li><a href="AdminLTE-master/pages/examples/profile.php" class="nav-link__list">pro</a></li>
				  <li><a href="deconnexion.php" class="nav-link__list">Déconnexion</a></li>
                </ul>
            </li>
		</ul>	
	</div> <!-- END container-->		
  </nav> <!-- END ec-nav --> 
			