<?php    
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    session_start2();
    
    $functions = new functions();    
    
    if (!$_SESSION['sPersonLogged'])
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
        <title><?php echo SIS_TITULO; ?> - Chat e PPV</title>
        <meta name="description" content="">
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
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/chat.css" type="text/css" media="screen" />
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
	                                <h1 class="text-white text-uppercase">Planos de Contrata&ccedil;&atilde;o</h1>
	                                <ol class="breadcrumb">
	                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
	                                    <li class="active"><a href="<?php echo SIS_URL; ?>plans">Planos de Contrata&ccedil;&atilde;o</a></li>
	                                </ol>
	                            </div>
	                        </div>
	                    </div><!--End off row-->
	                </div><!--End off container -->
	            </section> <!--End off Home Sections-->


				<section id="blog_details" class="blog_details roomy-100 listplans">
	                 <div class="container">
	                    <div class="row">
	                    	<div class="col-md-12">
	                    	<h4> 
			                                            <p><strong><i class="fa fa-warning"></i> REGRAS PARA PUBLICA&Ccedil;&Atilde;O DO SEU AN&Uacute;NCIO</strong></p>
													</h4>	
													<h6>	
														<p>An&uacute;ncio restrito apenas para maiores de <strong>18 ANOS</strong>, respeitando as seguintes imposi&ccedil;&otilde;es:</p>											
														<p><strong>a.</strong> Todas as informa&ccedil;&otilde;es contidas no(s) seu(s) an&uacute;ncio(s) devem serem VERDADEIRAS bem como sua identidade e o prop&oacute;sito do mesmo.</p>
														<p><strong>b.</strong> S&oacute; &eacute; permitido imagens de semi-nudez, onde a regi&atilde;o genital DEVE estar completamente coberta.</p> 
														<p><strong>c.</strong> &Eacute; expressamente <strong>PROIBIDO</strong> inserir contendo sexo expl&iacute;cito em seu(s) an&uacute;ncio(s)! As imagens devem conter somente a divulga&ccedil;&atilde;o da(o)(s) acompanhante(s), exibindo seu(s) f&iacute;sico(s), cobrindo a regi&atilde;o genital. Em caso de d&uacute;vidas, contate nosso apoio no email anuncio@escort.com.</p> 
														<p><strong>d.</strong> Ao adicionar seu an&uacute;ncio, voc&ecirc; estar&aacute; concordando com nossos <a href="">Termos de Uso</a>.</p> 
														<p><strong>e.</strong> Marcando a op&ccedil;&atilde;o <strong>'ESTOU DE ACORDO'</strong> abaixo, voc&ecirc; concorda no fato de que o <?php echo SIS_TITULO; ?> n&atilde;o tem uso, participa&ccedil;&atilde;o ou co-participa&ccedil;&atilde;o no(s) seu(s) an&uacute;ncio(s) publicado(s) no site, e tamb&eacute;m, voc&ecirc; concorda que o site <?php echo SIS_TITULO; ?> tem o livre direito de apagar o(s) an&uacute;ncio(s) e banir sua conta de usu&aacute;rio, caso venha a infringir os Termos de Uso.</p>
														<p><strong>f.</strong> Todos os an&uacute;ncios inseridos no <?php echo SIS_TITULO; ?> s&atilde;o analisados antes de serem publicados pela nossa equipe e, caso n&atilde;o estejam de acordo com os Termos de Uso, ser&atilde;o automaticamente removidos, podendo acarretar no banimento da conta do usu&aacute;rio publicador.</p> 
														<p><strong>g.</strong> O site <?php echo SIS_TITULO; ?> tem o direito de enviar toda e qualquer informa&ccedil;&atilde;o (E-mail, Telefone, IP e documentos) para as autoridades respons&aacute;veis, em caso de investiga&ccedil;&atilde;o, decis&atilde;o judicial, ou no caso de voc&ecirc; violar os Termos de Uso do <?php echo SIS_TITULO; ?>.</p>
			                                         </h6>
			                                         <div class="row"> 
			                                           <div class="col-sm-12">                                                                                          
			                                                <div class="form-group">
			                                                    <input type="checkbox" id="aceite" name="aceite" data-error="Voc&ecirc; deve estar de acordo com os Termos de Uso do site antes de publicar seu an&uacute;ncio!" required> <strong>ESTOU DE ACORDO! QUERO PUBLICAR MEU AN&Uacute;NCIO</strong>
			                                                    <div class="help-block with-errors"></div>
			                                                </div> 
			                                            </div>
			                                         </div> 
			                                         <hr/>
	                    	</div>
	                    	
	                    
	                    
	                    	<div class="col-md-7">
	                    		<h4><i class="fa fa-video-camera"></i> PPV</h4>
	                    		<video width="100%" controls>
								  <!-- source src="mov_bbb.mp4" type="video/mp4">
								  <source src="mov_bbb.ogg" type="video/ogg"-->
								  Your browser does not support HTML5 video.
								</video>
	                    	</div>
	                    	
	                    	
	                    	
	                        <div class="col-md-5">
	                            	<form method="post" role="form" name="form-ad" id="form-ad" data-toggle="validator">
                                       	<h4><i class="fa fa-send"></i> Chat com <?php echo $functions->fReduceName($_SESSION['sPersonAka']); ?></h4>
			                            		<div class="row">
	                                         		<div class="col-sm-12">                                                                                          
		                                                <div class="form-group">
		                                                	<div class="chat_wrapper">
		                                                    	<div class="message_box" id="message_box"></div>
		                                                    	<div class="help-block typing">ds</div>
		                                                    </div>
		                                                </div> 
		                                            </div>
				                               <?php if (empty($retAd[0]['apid'])){ ?>
			                                       <div class="col-sm-12">                                                                                          
		                                                <div class="form-group">
		                                                	<input type="hidden" name="room" id="room" value="<?php echo $_SESSION['sPersonID']; ?>">					                                                	 
		                                                    <input type="checkbox" name="private" id="private" value="1"> <strong>Conversar reservadamente com <?php echo $functions->fReduceName($_SESSION['sPersonAka']); ?>!</strong>
		                                                </div> 
		                                            </div>
		                                        <?php } ?>                                         	                                            
	                                            <div class="col-sm-12">
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-question-circle"></i> Digite a sua Mensagem *</label>
	                                                    <textarea id="message" maxlength="180" name="message" onkeydown = "if (event.keyCode == 13)document.getElementById('send-btn').click()" data-error="Por favor, informe a Mensagem!" required class="form-control" rows="4"></textarea>
	                                                    <div class="help-block with-errors"></div>
	                                                </div>	                                                
	                                            </div>	                                               
                                         </div>                                                                                
                                            
                                        <div class="row">                                           	
                                            <div class="col-sm-12 direita">  
                                            	<a href="<?php echo SIS_URL; ?>dashboard" class="btn btn-warning m-top-30">Sair <i class="fa fa-remove"></i></a>                                              
                                                <button type="button" id="send-btn" class="btn btn-primary m-top-30">Enviar <i class="fa fa-send"></i></button>                                                
                                            </div>                                                                                        
                                         </div>
                                  </form>
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
        <script>var $personChatPort = '<?php echo $_SESSION['sPersonID']; ?>';</script>
        <script>var $userChatNickname = '<?php echo $_COOKIE['cUserNickname']; ?>';</script>
        <script>var $personChatNickname = '<?php echo $functions->fReduceName($_SESSION['sPersonAka']); ?>';</script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/isotope.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.easing.1.3.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/slick.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.ui.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/chat.js"></script>
    </body>
</html>