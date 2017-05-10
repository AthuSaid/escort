<?php
    session_start();
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  
     
    if ($_SESSION['sPersonLogged'])
    {
    	if ($_SESSION['sPersonUrl'])
    	{
    		$retPerson = $functions->fGetPersonRegister($_SESSION['sPersonUrl']);
    		 
    		if (count($retPerson) == 0)
    		{
    			header('Location: '.SIS_URL.'signup');
    			exit;
    		}
    		
    	}else{
    		
    		header('Location: '.SIS_URL.'signup');
    		exit;
    	}    	
    	
    }else{
    	
    	header('Location: '.SIS_URL.'home');
    	exit;
    }
    
    $countAds = $functions->fGetCountDashboardAds($retPerson[0]['pesid']);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - Meus An&uacute;ncios</title>        
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
                                <h1 class="text-white text-uppercase">Minha Conta</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?>dashboard">Minha Conta</a></li>
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
                                                    <li><a href="#" class="text-black"><?php echo $_SESSION['sPersonLastLogon']; ?></a></li>
                                                    <li><a href="#" class="text-black"><?php echo $_SESSION['sPersonAka']; ?></a></li>
                                                    <li><a href="#" class="text-black"><?php echo ($countAds == 0 ? "Nenhum an&uacute;ncio cadastrado!" : "{$countAds} an&uacute;ncios cadastrados"); ?></a></li>
                                                </ul>
                                                <ul class="list-inline">                                                    
                                                    <li><a href="<?php echo SIS_URL?>payment" class="text-black">Seu Plano atual &eacute; o <strong>Plano <?php echo $_SESSION['sPersonPlanName']; ?></strong> - com vencimento em <strong><?php echo $functions->fInvertDateBrazil($_SESSION['sPersonPlanExpiresDate'], false); ?></strong></a></li>                                                    
                                                </ul>
                                            </div>
                                        </div> 
                                        <div class="blog_details_figure m-top-40">
                                        
                                        <?php if($_SESSION['sPersonPlanID'] == 0){ ?>
                                            <h6>Para dar prosseguimento a inclus&atilde;o de seus an&uacute;ncios, 
	                                            voc&ecirc; deve aderir a algum dos planos dispon&iacute;veis em nosso site!<br>
	                                            <br>Clique no bot&atilde;o <strong>CONTRATAR UM PLANO AGORA</strong> para assinar um plano que melhor atenda a sua necessidade!</h6>
										<?php }elseif ($_SESSION['sPersonPlanID'] != 0 && $_SESSION['sPersonPlanExpires'] <= 5 && $_SESSION['sPersonPlanPaid'] > 0){ ?>
											<h4><i class="fa fa-warning"></i> Seu <strong>Plano <?php echo $_SESSION['sPersonPlanName']; ?></strong> <?php echo $functions->fPlanExpires($_SESSION['sPersonPlanExpires']); ?>!</h4><br>  
	                                            <h6>Voc&ecirc; deve renovar para algum dos planos dispon&iacute;veis para que seus an&uacute;ncios e fotos continuem dispon&iacute;veis no site e nos mecanismos de busca!<br>
	                                            <br>Clique no bot&atilde;o <strong>RENOVAR PLANO</strong> para renovar sua assinatura!</h6>
										<?php }elseif ($_SESSION['sPersonPlanID'] > 1 && $_SESSION['sPersonPlanPaid'] < 1){ ?>
											<h4><i class="fa fa-warning"></i> Seu <strong>Plano <?php echo $_SESSION['sPersonPlanName']; ?></strong> foi contratado com sucesso por&eacute;m ainda est&aacute;<br>&nbsp;&nbsp;aguardando a comprova&ccedil;&atilde;o do pagamento pela Institui&ccedil;&atilde;o Financeira!</h4><br>  
	                                            <h6>Voc&ecirc; s&oacute; poder&aacute; incluir an&uacute;ncios ap&oacute;s o retorno desta comprova&ccedil;&atilde;o!<br>
	                                            <br>Fique tranquil<?php echo $functions->fReference($retPerson[0]['sexo']);?>! O vencimento contar&aacute; a partir da data da comprova&ccedil;&atilde;o do pagamento!</h6>
										<?php } ?>
										
                                            <blockquote class="m-top-30 m-l-30">
                                                <h5>
                                                    <em><?php echo $retPerson[0]['status']; ?></em>                                                    
                                                </h5>
                                                <p style="color:red"><?php echo $retPerson[0]['mensagem']; ?></p>
                                            </blockquote>
												

												<a href="<?php echo SIS_URL; ?>profile" class="btn btn-primary m-top-30">Editar meu Perfil <i class="fa fa-user"></i></a>												
												<?php if($_SESSION['sPersonPlanID'] == 0){ ?>
													<a href="<?php echo SIS_URL; ?>payment" class="btn btn-warning m-top-30">Contratar um Plano Agora <i class="fa fa-cart-plus"></i></a>
												<?php }elseif($_SESSION['sPersonPlanID'] != 0 && $_SESSION['sPersonPlanExpires'] <= 5){ ?>
													<a href="<?php echo SIS_URL; ?>payment" class="btn btn-warning m-top-30">Renovar Plano <i class="fa fa-cart-plus"></i></a>													
												<?php } ?>
												<a href="<?php echo SIS_URL; ?>remove" style="float: right; margin-top:40px;">Remover Conta</a>																																					
												
                                            <p class="m-top-30"><strong><i class="fa fa-question-circle"></i> ATEN&Ccedil;&Atilde;O:</strong> Todos os dados de todos os perfis no <?php echo SIS_TITULO;?>, assim como os an&uacute;ncios e fotos 
                                              passam por um processo de verifica&ccedil;&atilde;o de autenticidade e 
                                              controle de preven&ccedil;&atilde;o de pr&aacute;ticas criminosas, como pedofilia e 
                                              aliciamento de menores de 18 anos. Todos os dados s&atilde;o mantidos em sigilo, 
                                              e ser&atilde;o disponibilizados a &oacute;rg&atilde;os superiores, quando solicitado!</p>

                                        </div>

                                    </div>
                                </div>
                                
                                <?php if($retPerson[0]['aprovado'] == 1 && $_SESSION['sPersonPlanExpires'] >= 0){ ?>
	                                <hr />
	                                <div class="blog_comments">
	                                    <h4 class="m-bottom-30">Meus An&uacute;ncios</h4>
	
	                                    <?php echo $functions->fGetDashboardAds($retPerson[0]['pesid']); ?>
	
											<div class="row">                                           	
	                                            <div class="col-sm-12 direita btnads">
	                                            	<!--a href="<?php echo SIS_URL; ?>signout" class="btn btn-warning m-top-30 cancel">Logout <i class="fa fa-sign-out"></i></a-->
	                                            	<?php if ($countAds < $_SESSION['sPersonMaxAds'] && $_SESSION['sPersonPlanPaid'] > 0) { ?>                                                                                            
	                                                	<a href="<?php echo SIS_URL; ?>ad" class="btn btn-primary m-top-30 next">Inserir Novo An&uacute;ncio <i class="fa fa-plus"></i></a>
	                                                <?php } ?>	                                                                                                
	                                            </div>                                                                                        
	                                         </div>
	                                </div><!-- End off Blog comments -->
                                <?php } ?>
                                
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
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/counter.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>
    </body>
</html>
