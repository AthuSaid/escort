<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
	
	session_start2();
    
    $functions = new functions();  
?> 
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?></title>
        <meta name="description" content="<?php echo SIS_DESCRICAO; ?>">
        <meta name="robots" content="index,follow" />
		<meta name="googlebot" content="index,follow" />
		<meta name="google" content="translate" />
		<meta name="google" content="nositelinkssearchbox" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?php echo SIS_URL; ?>favicon.ico">
        <!--Google Fonts link-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/slick.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/slick-theme.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/animate.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/fonticons.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/bootsnav.css">		        
		<link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/jquery.modal.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/jquery.ui.css" type="text/css" media="screen" />
        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->
        <!--Theme custom css -->       
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/banner.php">        
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->
        <!--Theme Responsive css-->
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/responsive.css" />
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">


        <!-- Preloader -->

        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                    <div class="object"></div>
                </div>
            </div>
        </div>

        <!--End off Preloader -->

        <div class="culmn">
            <!--Home page style-->

			<!-- MENU DE NAVEGACAO NO HEADER -->
            <?php require_once '_requires/nav.php' ;?>


			<!-- DESTAQUE HOME - MODELO DESTAQUE POSTER (1) -->
            <?php echo $functions->fCreateFeaturedModels(1); ?>


            <!--About Sections-->
            <section id="feature" class="feature p-top-100">
                 
                                
                <!-- DESTAQUE HOME - MODELO DESTAQUE LIVRETO (2) -->
            	<?php echo $functions->fCreateFeaturedModels(2); ?>


				<!-- CONTADORES DINAMICOS DE USO DO SITE -->
                <?php require_once '_requires/counters.php'; ?>


                <!-- DESTAQUE HOME - MODELO DESTAQUE LISTA (3) COM LIMITE DE 4 PESSOAS -->
            	<?php echo $functions->fCreateFeaturedModels(3, 4); ?>


				<!-- APRESENTACAO E OBJETIVO DO SITE -->
                <div class="container">
                    <div class="row">
                        <div class="service_content_area">
                        	<div class="col-md-12">
                                <div class="head_title text-left sm-text-center wow fadeInDown">
                                    <h3>Seja <?php echo SIS_TITULO; ?>!</h3>
                                    <h5><em>Venha desfrutar de momentos relaxantes com as melhores pessoas em <?php echo SIS_TITULO;?>!</em></h5>                                    
                                </div>
                            </div>
                            <div class="col-md-4 service_left wow fadeInLeft">                                                                
                                <div class="service_items">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="hexagon">
                                                <div class="about-content">
                                                    <span class="fa font-bubble">18+</span>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-left service_left_text">
                                                <h4 class="main-color black">Conte&uacute;do Adulto</h4>
                                                <p>Divulga&ccedil;&atilde;o exclusiva de perfis maiores de 18 anos com comprova&ccedil;&atilde;o de identidade.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                               
                                <div class="service_items">
                                    <div class="row">
                                        <!-- ICON -->
                                        <div class="col-xs-3">
                                            <div class="hexagon">
                                                <div class="about-content">
                                                    <span class="fa fa-eye"></span>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-left service_left_text">
                                                <h4 class="main-color">Maior Visibilidade nas Buscas</h4>
                                                <p>O <?php echo SIS_TITULO;?> investe pesado em mecanismos de busca na Internet para divulgar seus perfis</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="service_items">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="hexagon">
                                                <div class="about-content">
                                                    <span class="fa fa-credit-card"></span>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-left service_left_text">
                                                <h4 class="main-color">Contate Diretamente a Pessoa</h4>
                                                <p>O <?php echo SIS_TITULO;?> n&atilde;o intermedia valores de Cach&ecirc;s ou qualquer encontro casual</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>

	                            <div class="col-md-4 sm-m-top-40 sm-text-center">
	                                <div class="service-img wow bounceIn">
	                                    <img src="assets/img/home-<?php echo $functions->genderPrefer;?>-<?php echo rand(1,2);?>.png" alt="Home Couple">
	                                </div>
	                            </div>

                            <div class="col-md-4 service_right wow fadeInRight sm-m-top-40" >
                                <div class="service_items">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <div class="service_right_text p-l-15 text-right">
                                                <h4 class="main-color">Publique Fotos & V&iacute;deos</h4>
                                                <p>Divulge seus ensaios de fotos e v&iacute;deos e alcance maiores resultados!</p>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="hexagon">
                                                <div class="about-content">
                                                    <span class="fa fa-camera"></span>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="service_items">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <div class="service_right_text p-l-15 text-right">
                                                <h4 class="main-color">Site Multi Generos</h4>
                                                <p>Aqui, o espa&ccedil;o &eacute; livre para quem quiser anunciar. Sem distin&ccedil;&atilde;o! Fique a Vontade</p>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="hexagon">
                                                <div class="about-content">
                                                    <span class="fa fa-venus-mars"></span>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="service_items">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <div class="service_right_text p-l-15 text-right">
                                                <h4 class="main-color">Perfis Aut&ecirc;nticos</h4>
                                                <p>Todos os perfis passam por uma Pr&eacute; Aprova&ccedil;&atilde;o antes de ser divulgado</p>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="hexagon">
                                                <div class="about-content">
                                                    <span class="fa fa-check"></span>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- GALERIA EM DESTAQUE NA HOME (1) ################### -->
            <?php echo $functions->fCreateGallery(1); ?>            


            <!-- TESTEMUNHAS DE USO DOS USUARIOS ################### -->
            <?php //echo $functions->fCreateUserTestimonials(); ?>


			<!-- DESTAQUE HOME - MODELO DESTAQUE NOVAS PESSOAS (4) COM LIMITE DE 11 PESSOAS 
				 PARA ICONE LISTA COMPLETA COMPLETAR O GRID DE 12 ITENS ################### -->
            <?php echo $functions->fCreateFeaturedModels(4, 11); ?>


			<!-- MENU DE NAVEGACAO - FOOTER -->
            <?php require_once '_requires/footer.php'; ?>

        </div>

        <!-- JS includes -->  
        <script>var $urlProj = '<?php echo SIS_URL; ?>';</script>      
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.ui.js"</script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/bootstrap.min.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/isotope.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.easing.1.3.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/slick.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.modal.min.js"</script>        
		<script src="<?php echo SIS_URL; ?>assets/js/select2.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>   
        <script src="<?php echo SIS_URL; ?>assets/js/counter.js"></script> 
        <script src="<?php echo SIS_URL; ?>assets/js/cookie.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>                    
    </body>
</html>
