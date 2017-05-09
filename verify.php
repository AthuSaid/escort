<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  
    
    $email = $functions->fDecrypt($_GET['hash']);
    
    $retPerson = $functions->fRetrievePassword(trim($email));
    	
    if (count($retPerson) == 0)
    {
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
        <title><?php echo SIS_TITULO; ?> - Recuperar Senha</title>        
        <meta name="robots" content="index,follow" />
		<meta name="googlebot" content="index,follow" />
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
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/select2.css" type="text/css" media="screen" />
        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->
        <!--Theme custom css -->
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/style.css">
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


            <!--Home Sections-->
            <section id="hello" class="blog-banner bg-mega">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="about_text">
                                <h1 class="text-white text-uppercase">Recuperar Senha</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?><?php echo ($_SESSION['sPersonLogged'] ? "profile" : "signup");?>">Cadastro</a></li>
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
                                <div class="live_chate">
                                
                                <form method="post" role="form" name="form-retrieve" id="form-retrieve" data-toggle="validator">
                                                                    	   
                                         <h4>Recupera&ccedil;&atilde;o de Senha</h4>                                         
                                         <div class="row">                                         
	                                            <div class="col-sm-4">                                                                                          
	                                                <div class="form-group">
	                                                    <label>E-mail *</label>                                                    
	                                                    <input type="email" id="email" name="email" data-error="Por favor, informe um e-mail v&aacute;lido" class="form-control disabled" readonly placeholder="Informe um E-mail v&aacute;lido!" value="<?php echo ($retPerson[0]['email'] != '' ? $retPerson[0]['email'] : $_SESSION['sPersonPreEml']); ?>" maxlength="50">
	                                                	<div class="help-block with-errors email"></div>
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-4">                                              
	                                                <div class="form-group">
	                                                    <label>Senha *</label>
	                                                    <input type="password" id="senha" name="senha" data-error="Por favor, informe uma senha." required class="form-control" placeholder="M&iacute;nimo de 8 caracteres!" maxlength="100">
	                                                    <div class="help-block with-errors"></div>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-4">                                                 
	                                                <div class="form-group">
	                                                    <label>Confirme a Senha *</label>
	                                                    <input type="password" id="csenha" name="csenha" data-match="#senha" data-error="As senhas n&atilde;o conferem!" required class="form-control" placeholder="Repita a senha que escolheu!" maxlength="100">
	                                                	<div class="help-block with-errors"></div>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-12 direita">                                                
                                                <a href="<?php echo SIS_URL.'home'; ?>" class="btn btn-warning m-top-30">Voltar <i class="fa fa-arrow-left"></i></a>
                                                <button type="submit" class="btn btn-primary m-top-30 retrieve">Alterar Senha <i class="fa fa-check"></i></button>                                                
                                            </div>
                                          </div>
                                         </form>
                                        
                                    </div>
                                </div>
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
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.modal.min.js"</script>
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/masonry.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/select2.full.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery.balloon.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.mask.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.ui.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/counter.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/balloon.js"></script>
              
    </body>
</html>