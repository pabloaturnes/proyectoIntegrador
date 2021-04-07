<!DOCTYPE html>
<html lang="es">
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="{{ asset('web/img/fav-icon.png') }}" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Jennifer Salazar Pasteleria</title>

        <!-- Icon css link -->
        <link href="{{ asset('css/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('web/vendors/linearicons/style.css') }}" rel="stylesheet">
        <link href="{{ asset('web/vendors/flat-icon/flaticon.css') }}" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="{{ asset('web/css/bootstrap.min.css') }}" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="{{ asset('web/vendors/revolution/css/settings.css') }}" rel="stylesheet">
        <link href="{{ asset('web/vendors/revolution/css/layers.css') }}" rel="stylesheet">
        <link href="{{ asset('web/vendors/revolution/css/navigation.css') }}" rel="stylesheet">
        <link href="{{ asset('web/vendors/animate-css/animate.css') }}" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="{{ asset('web/vendors/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('web/vendors/magnifc-popup/magnific-popup.css') }}" rel="stylesheet">
        
        <link href="{{ asset('web/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('web/css/responsive.css') }}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!--================Main Header Area =================-->
		<header class="main_header_area">
			<div class="top_header_area row m0">
				<div class="container">
					<div class="float-left">
						<a href="tell:+5491124869407"><i class="fa fa-phone" aria-hidden="true"></i> +54 9 11 2486 9407</a>
						<a href="pedidos@jennifersalazar.com.ar"><i class="fa fa-envelope-o" aria-hidden="true"></i> pedidos@jennifersalazar.com.ar</a>
					</div>
					<div class="float-right">
						<ul class="h_social list_style">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
						<ul class="h_search list_style">
							<li class="shop_cart"><a href="#"><i class="lnr lnr-cart"></i></a></li>
							<li><a class="popup-with-zoom-anim" href="#test-search"><i class="fa fa-search"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="main_menu_area">
				<div class="container">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand" href="index.html">
						<img src="/web/img/logo.svg" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="my_toggle_menu">
                            	<span></span>
                            	<span></span>
                            	<span></span>
                            </span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
								<li class="active">
									<a href="/" role="button" aria-haspopup="true" aria-expanded="false">Inicio</a>
								</li>
								<li><a href="/nosotros">Nosotros</a></li>
								<li><a href="/tienda">Tienda</a></li>
							</ul>
							<ul class="navbar-nav justify-content-end">
								<li class="dropdown submenu">
									<a href="/seminarios" role="button" aria-haspopup="true" aria-expanded="false">Seminarios</a>
									
								</li>
								<li class="dropdown submenu">
									<a href="/faq" role="button" aria-haspopup="true" aria-expanded="false">FAQ</a>
			
								</li>
								<li class="dropdown submenu">
									<a href="/contacto" role="button" aria-haspopup="true" aria-expanded="false">Contacto</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</header>
        <!--================End Main Header Area =================-->
        
        @yield('contenido')


        <!--================Newsletter Area =================-->
        <section class="newsletter_area">
        	<div class="container">
        	</div>
        </section>
        <!--================End Newsletter Area =================-->
        
        <!--================Footer Area =================-->
        <footer class="footer_area">
        	<div class="footer_widgets">
        		<div class="container">
        			<div class="row footer_wd_inner">
        				<div class="col-lg-3 col-6">
        					<aside class="f_widget f_about_widget">
        						<img src="web/img/logo.svg" alt="">
        						<p>Pasteleria creativa.</p>
        						<ul class="nav">
        							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
        							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
        						</ul>
        					</aside>
        				</div>
        				<div class="col-lg-4 col-6 offset-sm-1">
        					<aside class="f_widget f_link_widget">
        						<div class="f_title">
        							<h3>Horarios</h3>
        						</div>
        						<ul class="list_style">
        							<li><a>Lunes a Sabados de 9:00 a 21:00</a></li>
        						</ul>
        					</aside>
        				</div>
        				<div class="col-lg-3 col-6">
        					<aside class="f_widget f_contact_widget">
        						<div class="f_title">
        							<h3>Contacto</h3>
        						</div>
        						<h4></h4>
        						<p>Direccion <br />Ecuador 8052, Moreno, Buenos Aires</p>
        						<h5>pedidos@jennifersalazar.com.ar</h5>
        					</aside>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="footer_copyright">
        		<div class="container">
        			<div class="copyright_inner">
        				<div class="float-left">
        					<h5><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></h5>
        				</div>
        				<div class="float-right">
        					<a href="#">Purchase Now</a>
        				</div>
        			</div>
        		</div>
        	</div>
        </footer>
        <!--================End Footer Area =================-->
        
        
        <!--================Search Box Area =================-->
        <div class="search_area zoom-anim-dialog mfp-hide" id="test-search">
            <div class="search_box_inner">
                <h3>Buscar</h3>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="icon icon-Search"></i></button>
                    </span>
                </div>
            </div>
        </div>
        <!--================End Search Box Area =================-->
        
        
        
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('web/js/jquery-3.2.1.min.js') }}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('web/js/popper.min.js') }}"></script>
        <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
        <!-- Rev slider js -->
        <script src="{{ asset('web/vendors/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('web/vendors/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{ asset('web/vendors/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
        <script src="{{ asset('web/vendors/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
        <script src="{{ asset('web/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
        <script src="{{ asset('web/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
        <script src="{{ asset('web/vendors/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
        <!-- Extra plugin js -->
        <script src="{{ asset('web/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('web/vendors/magnifc-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('web/vendors/datetime-picker/js/moment.min.js') }}"></script>
        <script src="{{ asset('web/vendors/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('web/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('web/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('web/vendors/lightbox/simpleLightbox.min.js') }}"></script>
        
        <script src="{{ asset('web/js/theme.js') }}"></script>
    </body>

</html>