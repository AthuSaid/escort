<?php
    session_start();
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  
     
    if (!isset($_SESSION['sPersonLogged']))
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
        <title><?php echo SIS_TITULO; ?> - Planos de Contrata&ccedil;&atilde;o</title>        
        <meta name="robots" content="noindex,nofollow" />
		<meta name="googlebot" content="noindex,nofollow" />
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
	            <section id="hello" class="dash-banner-<?php echo $functions->genderPrefer.rand(1,2);?> bg-mega">
	                <div class="container">
	                    <div class="row">
	                        <div class="main_home text-center">
	                            <div class="about_text">
	                                <h1 class="text-white text-uppercase shadow-text">Planos de Contrata&ccedil;&atilde;o</h1>
	                                <ol class="breadcrumb shadow-text">
	                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
	                                    <li><a href="<?php echo SIS_URL; ?>dashboard">Minha Conta</a></li>
	                                    <li class="active"><a href="<?php echo SIS_URL; ?>payment">Planos de Contrata&ccedil;&atilde;o</a></li>
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
	                            <div class="main_blog_details">
	                                <div class="blog_details_left">                                    
	                                    <div class="blog_details_content">
	                                        <div class="blog_details_head m-top-40">
	                                            <div class="blog_date">
	                                                <span><?php echo date('d'); ?></span><br />
	                                                <span><?php echo $functions->fGetReduceMonth(date('m')); ?></span>
	                                            </div>
	                                            <div class="head_text">
	                                                <h2><?php echo $functions->fWelcomeMessage($_SESSION['sPersonAka'], $_SESSION['sPersonGender'], $_SESSION['sPersonComeBack']); ?></h2>
	                                                <ul class="list-inline">                                                    
	                                                    <li><a href="#" class="text-black">Escolha o melhor plano dispon&iacute;vel que atenda sua necessidade:</a></li>                                                   
	                                                </ul>
	                                            </div>
	                                        </div> 
	                                        <div class="blog_details_figure m-top-40">                                         
	                                            
												<div class="row">
												
													<?php echo $functions->fGetPlans(1, $_SESSION['sPersonPlanID']); ?>
																																				
												</div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div><!-- End off col-md-8 -->
	                    </div><!-- End off row -->
	               </div><!-- End off container -->
	            </section><!-- End off blog Fashion -->

            <!--Blog Features Section-->
            <section id="blog_details" class="roomy-100 blog_details payment-methods hidden">
                <div class="container">
                    <div class="row">
                            
                      <div class="direita" style="text-align: right"><h1><i class="fa fa-cc-visa"></i> <i class="fa fa-cc-mastercard"></i> <i class="fa fa-cc-diners-club"></i> <i class="fa fa-cc-amex"></i> <i class="fa fa-cc-paypal"></i>
                      	<i class="fa fa-barcode"></i></h1>Todas as transa&ccedil;&otilde;es s&atilde;o realizadas em Ambiente Seguro.</div>            							
						<h2>Parab&eacute;ns <?php echo $functions->fReduceName($_SESSION['sPersonAka']); ?>!</h2>							                           
                        <p>A partir de agora, voc&ecirc; est&aacute; assinando o seguinte plano:</p>
                        <h3 class="nomplan">PlanoX</h3>
                        <h4 class="valplan">ValorX</h4>
                        <p>Caso deseje alterar o plano antes de contrat&aacute-lo ou a forma de pagamento atual, <a href="<?php echo SIS_URL; ?>payment">clique aqui</a>!</p>
                    	<p class="m-bottom-40 m-top-30">Selecione a Forma de Pagamento desejada:</p>
                    		
                         <div class="col-md-6">
                            <div class="main_blog_details">
                                <div class="live_chate">                                
                                	<form method="post" role="form" name="form-payment" id="form-payment" data-toggle="validator">                                	                                                                     	
                                    	<div class="row">  
                                    	   <h3><i class="fa fa-credit-card"></i> Cart&atilde;o de Cr&eacute;dito</h3>
                                           <div class="col-sm-10">                                             		                                                                                          
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle"></i> Nome do Titular *</label>                                                    
                                                    <input type="text" tabindex="1" id="ct" name="ct" data-error="Por favor, informe o Nome Completo do Titular do Cart&atilde;o de Cr&eacute;dito!" required class="form-control frm-login eml" placeholder="Por favor, informe o Nome do Titular do Cart&atilde;o de Cr&eacute;dito!">
                                                	<div class="help-block with-errors"></div>
                                                </div> 
                                            </div>                                           
                                            <div class="col-sm-10">                                             	                                                                                         
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle"></i> N&uacute;mero do Cart&atilde;o *</label>                                                    
                                                    <input type="text" tabindex="3" id="cn" name="cn" maxlength="19" class="form-control" placeholder="Por favor, informe o N&uacute;mero do Cart&atilde;o de Cr&eacute;dito!">
                                                	<div class="help-block with-errors"></div>
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-12">
                                         		<label><i class="fa fa-question-circle"></i> M&ecirc;s e Ano de Vencimento *</label>
                                         	</div> 
                                            <div class="col-sm-2">                                             	                                                                                         
                                                <div class="form-group">                                                                                                      
                                                    <input type="text" tabindex="3" id="cm" name="cm" maxlength="2" class="form-control" placeholder="<?php echo date("m"); ?>">
                                                	<div class="help-block with-errors"></div>
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-3">                                             	                                                                                         
                                                <div class="form-group">                                                                                                        
                                                    <input type="text" tabindex="3" id="ca" name="ca" maxlength="4" class="form-control" placeholder="<?php echo date("Y"); ?>">
                                                	<div class="help-block with-errors"></div>
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-12">
                                         		<label><i class="fa fa-question-circle"></i> C&oacute;digo de Seguran&ccedil;a *</label>
                                         	</div> 
                                            <div class="col-sm-2">                                             	                                                                                         
                                                <div class="form-group">                                                                                                      
                                                    <input type="text" tabindex="3" id="cs" name="cs" maxlength="3" class="form-control" placeholder="123">
                                                	<div class="help-block with-errors"></div>
                                                </div>                                                                         
                                         	</div>                                         	                                           	
                                            <div class="col-sm-12">                                                
                                                <button type="button" class="btn btn-primary btn-pay">Avan&ccedil;ar <i class="fa fa-credit-card"></i></button>                                                                                                                                                                                                                                      
                                            </div>                                                                                       
                                          </div>	                                     
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 div-boleto">
                            <div class="main_blog_details">
                                <div class="live_chate">                                
                                	<form method="post" role="form" name="form-signin" id="form-signin" data-toggle="validator">                                	                                                                     	
                                    	<div class="row">  
                                    	   <h3><i class="fa fa-barcode"></i> Boleto Banc&aacute;rio</h3>                                  	 
                                           <div class="col-sm-12">                                             		                                                                                          
                                                <div class="form-group">
                                                    <h4 class="valplan">ValorX</h4>
                                                </div> 
                                            </div>                                           
                                            <div class="col-sm-6">                                             	                                                                                         
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle"></i> Selecione a melhor data para pagamento *</label>                                                    
                                                    <select name="vencimento" id="vencimento" class="form-control">
                                                    	<option value="5">Vencimento todo dia 5</option>
                                                    	<option value="10" selected>Vencimento todo dia 10</option>
                                                    	<option value="15">Vencimento todo dia 15</option>
                                                    	<option value="20">Vencimento todo dia 20</option>
                                                    	<option value="25">Vencimento todo dia 25</option>
                                                    </select>                                                	
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-12">                                             	                                                                                         
                                                <div class="form-group">
                                                    <label><i class="fa fa-warning"></i> O plano estar&aacute; ativo ap&oacute;s a compensa&ccedil;&atilde;o do boleto,<br>que pode variar entre 24 e 72 horas ap&oacute;s o pagamento!</label>                                                                                                      
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-12">                                                
                                                <button type="button" class="btn btn-primary btn-boleto">Gerar Boleto <i class="fa fa-barcode"></i></button>                                                                                                                                                                                                                                      
                                            </div>                                         	 
                                          </div>	                                     
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 div-installments hidden">
                              <div class="main_blog_details">
                                <div class="live_chate">                                
                                	<form method="post" role="form" name="form-signin" id="form-signin" data-toggle="validator">                                	                                                                     	
                                    	<div class="row">  
                                    	   <h3><i class="fa fa-credit-card"></i> Parcelamento</h3>                                  	 
                                           <div class="col-sm-12">                                             		                                                                                          
                                                <div class="form-group">
                                                    <h4 class="valplan">ValorX</h4>
                                                </div> 
                                            </div>                                           
                                            <div class="col-sm-6">                                             	                                                                                         
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle"></i> Parcelamento do Cart&atilde;o *</label>                                                    
                                                    <select name="installments" id="installments" class="form-control installments">                                                    	
                                                    </select>                                                	
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-12">                                             	                                                                                         
                                                <div class="form-group">
                                                    <label><i class="fa fa-warning"></i> O plano estar&aacute; ativo ap&oacute;s a confirma&ccedil;&atilde;o do pagamento,<br>pela institui&ccedil;&atilde;o financeira!</label>                                                                                                      
                                                </div>                                                                         
                                         	</div>
                                         	<div class="col-sm-12">                                                
                                                <button type="button" class="btn btn-warning btn-confirm">Confirmar Pagamento <i class="fa fa-check"></i></button>                                                                                                                                                                                                                                      
                                                
                                            </div>                                         	 
                                          </div>	                                     
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                        </div><!-- End off col-md-8 -->
                    </div><!-- End off row -->                
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
        <script src="<?php echo SIS_URL; ?>assets/js/payment.js"></script>
        <script type="text/javascript" src="<?php echo SIS_URL_PAGSEGURO; ?>"></script> 
        
        <script>
	        $('.remember').on('click', function(){
	        	$('.passw').addClass('hidden');
	        	$('.signin').addClass('hidden');
	        	$(this).addClass('hidden');	        	
	        	$('.resetpwd').removeClass('hidden');
	        	$('.cancel').removeClass('hidden');
	        	$('.apls').html('<i class="fa fa-unlock"></i> Lembrar Senha');
	        });
	        $('.cancel').on('click', function(){
	        	$('.passw').removeClass('hidden');
	        	$('.signin').removeClass('hidden');
	        	$(this).addClass('hidden');	        	
	        	$('.resetpwd').addClass('hidden');
	        	$('.remember').removeClass('hidden');
	        	$('.apls').html('<i class="fa fa-lock"></i> Acesso ao Portal');
	        });

	        $('#cn').mask("####.####.####.####");
	        $('#cm').mask("##");
	        $('#ca').mask("####");
	        $('#cs').mask("###");
        </script>
        
    </body>
</html>