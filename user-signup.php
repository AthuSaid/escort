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
    }
    
    # disable mandatory fields in edit approved user
    $disabled 		= ($retPerson[0]['aprovado'] == 1 ? 'class="form-control form-control-disabled disabled" readonly' : 'class="form-control"');       
    # disable input files in edit approved person
    $disabledFile 	= 'type="file" class="form-control"';
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - Novo Usu&aacute;rio</title>
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
                                <h1 class="text-white text-uppercase text-shadow"><?php echo ($_SESSION['sPersonLogged'] ? "Meu Cadastro" : "Acesso ao Usu&aacute;rio");?></h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li><a href="<?php echo SIS_URL; ?>profile">Minha Conta</a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?><?php echo ($_SESSION['sUserLogged'] ? "profile" : "user-signup");?>">Meu Cadastro</a></li>
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
                                
                                <form method="post" role="form" name="form-user-signup" id="form-user-signup" data-toggle="validator" enctype="multipart/form-data">
                                
                                    	<h4>Dados Pessoais</h4>                                    
                                    	<div class="row">
                                           <div class="col-sm-6">                                                                                          
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle nomcompl"></i> Nome Completo *</label>                                                    
                                                    <input type="text" id="nome" name="nome" data-error="Por favor, informe seu Nome Completo!" required class="form-control" value="<?php echo $retPerson[0]['nome']; ?>" placeholder="Seu nome Original. N&atilde;o ser&aacute; divulgado no site!" maxlength="50">
                                                	<div class="help-block with-errors"></div>
                                                </div> 
                                            </div>
                                            <div class="col-sm-6">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle nomfic"></i> Apelido *</label>                                                    
                                                    <input type="text" id="apelido" name="apelido" data-error="Por favor, informe um Apelido!" required <?php echo $disabled; ?> value="<?php echo ($retPerson[0]['apelido'] != '' ? $retPerson[0]['apelido'] : $_SESSION['sUserPreAka']); ?>" placeholder="Seu apelido que ser&aacute; utilizado no site!" maxlength="50">
                                                	<div class="help-block with-errors apelido"></div>
                                                </div>
                                            </div>
                                         </div>                                           
                                      
                                        
                                         <hr />   
                                         <h4>Acesso ao Portal</h4>                                         
                                         <div class="row">                                         
	                                            <div class="col-sm-4">                                                                                          
	                                                <div class="form-group">
	                                                    <label>E-mail *</label>                                                    
	                                                    <input type="email" id="email" name="email" data-error="Por favor, informe um e-mail v&aacute;lido" required <?php echo $disabled; ?> placeholder="Informe um E-mail v&aacute;lido!" value="<?php echo ($retPerson[0]['email'] != '' ? $retPerson[0]['email'] : $_SESSION['sUserPreEml']); ?>" maxlength="50">
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
                                          </div>
                                          
                                          <?php if (!empty($retPerson[0]['usrid'])){ ?>
	                                          <div class="row"> 
	                                           <div class="col-sm-12">                                                                                          
	                                                <div class="form-group">
	                                                    <input type="checkbox" class="active-person" value="1" <?php echo ($retPerson[0]['ativo'] == 1 ? 'checked' : ''); ?>> <strong>MANTER MEU CADASTRO ATIVO!</strong>
	                                                </div> 
	                                            </div>
	                                         </div>  
                                         <?php } ?>                                                                                                                                    
                                                                                        
                                         <hr />  
                                         <h4>Sexo, Nascimento & Foto</h4>
                                         <div class="row">
                                         	<div class="col-sm-4">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-venus-mars"></i> Eu Sou *</label>
                                                    <select id="sexo" name="sexo" data-error="Por favor, informe seu Sexo." required class="form-control sexo">
													  <option value="" selected>Selecione</option>
													  <option value="M" <?php echo ($retPerson[0]['sexo'] == 'M' ? 'selected' : ''); ?>>Homem</option>													   
													  <option value="F" <?php echo ($retPerson[0]['sexo'] == 'F' ? 'selected' : ''); ?>>Mulher</option>
													  <option value="T" <?php echo ($retPerson[0]['sexo'] == 'T' ? 'selected' : ''); ?>>Transg&ecirc;nero</option>
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>                                         
                                           <div class="col-sm-4">                                                                                          
                                                <div class="form-group">
                                                    <label><i class="fa fa-calendar"></i> Data de Nascimento *</label>                                                    
                                                    <input type="text" id="nascimento" name="nascimento" data-error="Por favor, sua data de Nascimento!" required <?php echo $disabled; ?> value="<?php echo $retPerson[0]['nascimento']; ?>">
                                                	<div class="help-block with-errors"></div>	
                                                </div> 
                                            </div>
                                            <div class="col-sm-4">                                                 
                                                <div class="form-group">
                                                    <label><i class="fa fa-photo"></i> Insira uma foto para seu Perfil</label>
                                                    <input id="avatar" name="avatar" <?php echo $disabledFile; ?>>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                         <div class="row">                                           	
                                            <div class="col-sm-12 direita">                                                
                                                <a href="<?php echo (!isset($_SESSION['sUserLogged']) ? SIS_URL.'home' : SIS_URL.'profile'); ?>" class="btn btn-warning m-top-30">Voltar <i class="fa fa-arrow-left"></i></a>
                                                <button type="submit" class="btn btn-primary m-top-30 signup">Salvar Perfil <i class="fa fa-check"></i></button>                                                
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
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.modal.min.js"</script>
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
        
        <script type="text/javascript">
				
				var options =  {		  
					  onComplete: function(val){
					    var date = val.split("/");
					    var currYear = <?php echo date("Y"); ?>;
					    if (((currYear - date[2]) < 18) || date[1] > 12 || date[0] > 31 || (date[0] > 29 && date[1] == 2))	
					    	$('#nascimento').val('');
				    		$('#nascimento').attr('placeholder', 'Proibido para menores de 18 anos!');	    
					  }
					};
				$('#nascimento').mask('00/00/0000', options);				
				
				$('.active-person').on('click', function(){	
					if (!$(this).is(':checked')) {
						if (confirm('Desmarcando esta op\u00e7\u00e3o, seu perfil n\u00e3o aparecer\u00e1 no portal, at\u00e9 que o mesmo seja ativado novamente. Deseja mesmo desativar?')) {
							$(this).attr('checked', false);
						}else{
							$(this).prop('checked', true);
						}
					}		
				});
				
			</script>        
    </body>
</html>