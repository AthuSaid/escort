<?php
    session_start();
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  
     
    if ($_SESSION['sPersonLogged'])
    {		
		header('Location: '.SIS_URL.'dashboard');
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
        <title><?php echo SIS_TITULO; ?> - Acesso</title>
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
	            <section id="hello" class="cad-banner bg-mega">	                
	                <div class="container">
	                    <div class="row">
	                        <div class="main_home text-center">
	                            <div class="about_text">
	                                <h1 class="text-white text-uppercase shadow-text">Cadastre-se</h1>
	                                <ol class="breadcrumb shadow-text">
	                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
	                                    <li class="active"><a href="<?php echo SIS_URL; ?>signup">Cadastre-se</a></li>
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
                                    	<h4> 
                                            <p><strong><i class="fa fa-warning"></i> ANTES DE PROSSEGUIR, LEIA ATENTAMENTE AS INSTRU&Ccedil;&Otilde;ES ABAIXO:</strong></p>
										</h4>	
										<h6>	
											<p>Cadastro restrito exclusivamente apenas para maiores de <strong>18 ANOS</strong>, que devem respeitar as seguintes imposi&ccedil;&otilde;es:</p>											
											<p><strong>a.</strong> Todas as informa&ccedil;&otilde;es contidas no seu cadastro devem serem VERDADEIRAS bem como sua identidade, fotos e documentos de comprova&ccedil;&atilde;o da mesma.</p>											
											<p><strong>b.</strong> Ao iniciar seu processo de cadastro abaixo em <strong>NOVO CADASTRO</strong>, voc&ecirc; voc&ecirc; estar&aacute; concordando com nossos <a href="<?php echo SIS_URL?>privacy" target="_blank">Termos de Uso</a>.</p>
											<p><strong>c.</strong> Todos os cadastros inseridos no <?php echo SIS_TITULO; ?> s&atilde;o analisados antes de serem publicados pela nossa equipe e, caso n&atilde;o estejam de acordo com os Termos de Uso, ser&atilde;o automaticamente removidos.</p>
											<p><strong>d.</strong> O site <?php echo SIS_TITULO; ?> tem o direito de enviar toda e qualquer informa&ccedil;&atilde;o (E-mail, Telefone, IP e documentos) para as autoridades respons&aacute;veis, em caso de investiga&ccedil;&atilde;o, decis&atilde;o judicial, ou no caso de voc&ecirc; violar os Termos de Uso do <?php echo SIS_TITULO; ?>.</p>
                                         </h6>
                                    	<hr/>
                                    	
                                    	<div class="row">                                    	                                    	 
                                           <div class="col-md-6">
                                           		<form method="post" role="form" name="form-signin-page" id="form-signin-page" data-toggle="validator">                                             		
		                                           	<div class="col-sm-12">  
		                                           		<h4 class="apls"><i class="fa fa-lock"></i> Acesso ao Portal</h4>                                                                                           
		                                                <div class="form-group">
		                                                    <label>E-mail *</label>                                                    
		                                                    <input type="hidden" id="page" name="page" value="<?php echo $_GET['page'];?>">
		                                                    <input type="email" tabindex="1" id="eml" name="eml" data-error="Por favor, informe seu Email de Acesso!" required class="form-control frm-login eml" placeholder="Por favor, informe seu Email de Acesso!">
		                                                	<div class="help-block with-errors login"></div>
		                                                </div> 
		                                            </div>
		                                            <div class="col-sm-12">                                             		                                                                                       
		                                                <div class="form-group passw">
		                                                    <label>Senha *</label>                                                    
		                                                    <input type="password" tabindex="2" id="pwd" name="pwd" data-error="Por favor, informe sua Senha!" required class="form-control frm-login" placeholder="Por favor, informe sua Senha!">
		                                                	<div class="help-block with-errors"></div>
		                                                </div>
		                                                <button type="button" class="btn btn-primary hidden m-top-30 m-bottom-70 resetpwd">Nova Senha <i class="fa fa-lock"></i></button>
		                                                <button type="button" class="btn btn-warning hidden m-top-30 m-bottom-70 cancel">Voltar</button> 
	                                            	</div>                                               
	                                            	<div class="col-sm-12">                                                 
		                                                <button type="submit" class="btn btn-primary m-top-30 m-bottom-70 signin">OK <i class="fa fa-sign-in"></i></button>
		                                                <button type="button" class="btn btn-warning m-top-30 m-bottom-70 remember">Nova Senha <i class="fa fa-lock"></i></button>
	                                                </div>
                                                </form>                                            
                                            </div> 
                                            
                                            <div class="col-md-6">
                                            	<form method="post" role="form" name="form-signup-page" id="form-signup-page" data-toggle="validator">
		                                            <div class="col-sm-12">
		                                            	<h4><i class="fa fa-sign-in"></i> Novo Cadastro</h4>                                             	                                                                                          
		                                                <div class="form-group">
		                                                    <label><i class="fa fa-question-circle"></i> Nome Fict&iacute;cio *</label>                                                    
		                                                    <input type="text" tabindex="3" id="apelido" name="apelido" data-error="Por favor, informe um Nome Fict&iacute;cio!" required class="form-control frm-apelido" placeholder="Por favor, informe um Nome Fict&iacute;cio V&aacute;lido!">
		                                                	<div class="help-block with-errors apelido"></div>
		                                                </div> 
		                                            </div>
		                                            <div class="col-sm-12">                                             	                                                                                          
		                                                <div class="form-group">
		                                                    <label><i class="fa fa-question-circle"></i> E-mail *</label>                                                    
		                                                    <input type="email" tabindex="4" id="n-eml" name="n-eml" data-error="Por favor, informe um E-mail v&aacute;lido!" required class="form-control frm-n-eml" placeholder="Por favor, informe um Email V&aacute;lido!">
		                                                	<div class="help-block with-errors n-eml"></div>
		                                                </div> 
		                                            </div>
		                                            <div class="col-sm-12">  
	                                                	<button type="submit" class="btn btn-primary m-top-30 m-bottom-70 signup">Novo Cadastro <i class="fa fa-user-circle"></i></button>
	                                                </div>
                                                </form>  
                                            </div>                                                                                                                             
                                         </div>                                    	                                                                                                                       
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
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.easing.1.3.js"></sript>
        <script src="<?php echo SIS_URL; ?>assets/js/slick.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/select2.full.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.mask.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.ui.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script> 
        
        <script>
	        $('.remember').on('click', function(){
	        	$('.passw').addClass('hidden');
	        	$('.signin').addClass('hidden');
	        	$(this).addClass('hidden');	        	
	        	$('.resetpwd').removeClass('hidden');
	        	$('.cancel').removeClass('hidden');
	        	$('.apls').html('<i class="fa fa-unlock"></i> Nova Senha');
	        });
	        $('.cancel').on('click', function(){
	        	$('.passw').removeClass('hidden');
	        	$('.signin').removeClass('hidden');
	        	$(this).addClass('hidden');	        	
	        	$('.resetpwd').addClass('hidden');
	        	$('.remember').removeClass('hidden');
	        	$('.apls').html('<i class="fa fa-lock"></i> Acesso ao Portal');
	        });
        </script>
        
    </body>
</html>