<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
	
	session_start2();
    
    $functions = new functions();  
     
    if ($_SESSION['sUserLogged'])
    {
    	$retPerson = $functions->fGetUserRegister($_SESSION['sUserID']);
    		 
    	if (count($retPerson) == 0)
    	{
    		header('Location: '.SIS_URL.'user-signup');
    		exit;
    	}	
    	
    }else{
    	
    	header('Location: '.SIS_URL.'home');
    	exit;
    }       
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - Painel do Usu&aacute;rio</title>        
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
        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->
        <!--Theme custom css -->
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/style.css">
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->
        <!--Theme Responsive css-->
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/responsive.css" />
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/jquery.ui.css" type="text/css" media="screen" />
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


            <!--Home Sections-->
            <section id="hello" class="dash-banner-<?php echo $functions->genderPrefer.rand(1,5);?> bg-mega">
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="about_text">
                                <h1 class="text-white text-uppercase shadow-text">Painel do Usu&aacute;rio</h1>
                                <ol class="breadcrumb shadow-text">
                                    <li><a href="<?php echo SIS_URL; ?>"><?php echo SIS_TITULO; ?></a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?>profile">painel do usu&aacute;rio</a></li>
                                </ol>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->

            <!--Blog Features Section-->
            <section id="blog_details" class="blog_details roomy-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main_blog_details">
                                <div class="blog_details_left">                                    
                                    <div class="blog_details_content">
                                        <div class="blog_details_head m-top-40">
                                            <div class="blog_date">
                                                <span><?php echo date('d'); ?></span><br />
                                                <span><?php echo $functions->fGetReduceMonth(date('m')); ?></span>
                                            </div>
                                            <div class="head_text">
                                                <h2><?php echo $functions->fWelcomeMessage($retPerson[0]['apelido'], $retPerson[0]['sexo'], $_SESSION['sPersonComeBack']); ?></h2>
                                                <ul class="list-inline">                                                    
                                                    <li><a href="#" class="text-black"><?php echo $_SESSION['sUserLastLogon']; ?></a></li>
                                                    <li><a href="#" class="text-black"><?php echo $_SESSION['sUserAka']; ?></a></li>                                                    
                                                </ul>                                                
                                            </div>
                                        </div> 
                                        <div class="blog_details_figure m-top-40">
                                            <blockquote class="m-top-30 m-l-30">
                                                <h5>
                                                    <em><?php echo $retPerson[0]['status']; ?></em>                                                    
                                                </h5>
                                                <?php 
                                                if ($_SESSION['sPersonPlanID'] != 0 && $_SESSION['sPersonPlanExpires'] > 5){
                                                	echo $retPerson[0]['mensagem'];
                                                } ?>
                                            </blockquote>												
											<a href="<?php echo SIS_URL; ?>user-signup" class="btn btn-primary m-top-30">Editar meu Perfil <i class="fa fa-user"></i></a>																								
											<a href="javascript:void();" class="btn-remove" style="float: right; margin-top:40px;">Remover Conta</a>
                                        </div>
                                    </div>
                                </div>
                                
                                
	                                <hr />
	                                <div class="blog_comments">
	                                    <h4 class="m-bottom-30">Meus Depoimentos</h4>
	
	                                    <?php echo $functions->fGetUserTestimonials($retPerson[0]['usuid']); ?>
	
											<div class="row">                                           	
	                                            <div class="col-sm-12 direita btnads">
	                                            	<a href="<?php echo SIS_URL; ?>signout" class="btn btn-warning m-top-30 cancel">Sair <i class="fa fa-sign-out"></i></a>	                                            	                                                                                           
	                                                <a href="<?php echo SIS_URL; ?>persons" class="btn btn-primary m-top-30 next">Visitar Perfis <i class="fa fa-user"></i></a>	                                                                                                
	                                            </div>                                                                                        
	                                         </div>
	                                </div><!-- End off Blog comments -->
                                
                                
                            </div>
                        </div><!-- End off col-md-8 -->
                    </div><!-- End off row -->
               </div><!-- End off container -->
            </section><!-- End off blog Fashion -->


            <!-- scroll up-->
            <div class="scrollup">
                <a href="#"><i class="fa fa-chevron-up"></i></a>
            </div><!-- End off scroll up -->


            <!-- MENU DE NAVEGACAO - FOOTER -->
            <?php require_once '_requires/footer.php'; ?>


        </div>

        <!-- JS includes -->
        <script>var $urlProj = '<?php echo SIS_URL; ?>';</script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/isotope.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.easing.1.3.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/slick.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.ui.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/counter.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>
    </body>
</html>
