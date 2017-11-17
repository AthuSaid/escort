<?php    
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    session_start2();
    
    $functions = new functions();  
    
    # check if logged to Testimonials CRD
    if ($_SESSION['sPersonLogged'] || $_SESSION['sUserLogged'])
    {    	
    	# check if person logged is the same of session logged
    	if (isset($_GET['person']) && $_SESSION['sPersonUrl'] == $_GET['person'])
    	{
    		$personID = $_SESSION['sPersonID'];
    		
    	}else{
    		
    		$retPerson = $functions->fGetPersonRegister($_GET['person']);
    		
    		$personID = ($retPerson[0]['pesid'] != '' && !$_SESSION['sPersonLogged'] ? $retPerson[0]['pesid'] : '0');
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
        <title><?php echo SIS_TITULO; ?> - Seus Depoimentos</title>
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
            <section id="hello" class="dash-banner-<?php echo $functions->genderPrefer.rand(1,2);?> bg-mega">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center shadow-text">
                            <div class="about_text">
                                <h1 class="text-white text-uppercase">Seus Depoimentos</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li><a href="<?php echo SIS_URL; ?>dashboard">Dashboard</a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?>testimonial">Seus Depoimentos</a></li>
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
                                
                                <form method="post" role="form" name="form-test" id="form-test" data-toggle="validator">
                                         
                                        <h4> 
                                            <p><strong><i class="fa fa-warning"></i> REGRAS PARA PUBLICA&Ccedil;&Atilde;O DO SEU DEPOIMENTO</strong></p>
										</h4>	
										<h6>	
											<p>Depoimento restrito apenas para maiores de <strong>18 ANOS</strong>, destinado aos perfis cadastrados no <?php echo SIS_TITULO; ?> e respeitando as seguintes imposi&ccedil;&otilde;es:</p>											
											<p><strong>a.</strong> Todas as informa&ccedil;&otilde;es contidas no(s) seu(s) depoimento(s) s&atilde;o de <strong>SUA &Uacute;NICA E INTEIRA RESPONSABILIDADE</strong> bem como sua identidade e o prop&oacute;sito do mesmo.</p>
											<p><strong>b.</strong> &Eacute; expressamente <strong>PROIBIDO</strong> inserir conte&uacute;dos de cunho ofensivo, de forma a caracterizar, racismo, preconceito, discrimina&ccedil;&atilde;o ou perjuria em seu(s) depoimento(s)!</p> 
											<p><strong>c.</strong> Ao adicionar seu depoimento, voc&ecirc; estar&aacute; concordando com nossos <a href="<?php echo SIS_URL; ?>privacy" target="_blank"><strong>Termos de Uso</strong></a>.</p> 
											<p><strong>d.</strong> Marcando a op&ccedil;&atilde;o <strong>'ESTOU DE ACORDO! QUERO PUBLICAR MEU DEPOIMENTO'</strong> abaixo, voc&ecirc; concorda no fato de que o <?php echo SIS_TITULO; ?> n&atilde;o tem uso, participa&ccedil;&atilde;o ou co-participa&ccedil;&atilde;o no(s) seu(s) depoimento(s) publicado(s) no site, e tamb&eacute;m, voc&ecirc; concorda que o site <?php echo SIS_TITULO; ?> tem o livre direito de apagar o(s) mesmo(s) e banir sua conta de usu&aacute;rio, caso venha a infringir os Termos de Uso.</p>
											<p><strong>e.</strong> Todos os depoimentos inseridos no <?php echo SIS_TITULO; ?> s&atilde;o analisados antes de serem publicados e, caso n&atilde;o estejam de acordo com os Termos de Uso, ser&atilde;o automaticamente removidos, podendo acarretar no banimento da conta do usu&aacute;rio publicador.</p> 
											<p><strong>f.</strong> O site <?php echo SIS_TITULO; ?> tem o direito de enviar toda e qualquer informa&ccedil;&atilde;o (E-mail, Telefone, IP e documentos) para as autoridades respons&aacute;veis, em caso de investiga&ccedil;&atilde;o, decis&atilde;o judicial, ou no caso de voc&ecirc; violar os Termos de Uso do <?php echo SIS_TITULO; ?>.</p>
											<p><strong>g.</strong> Marcando a op&ccedil;&atilde;o <strong>'ESTOU DE ACORDO! QUERO PUBLICAR MEU DEPOIMENTO'</strong>, voc&ecirc; AUTORIZA o uso de sua imagem e/ou voz e/ou v&iacute;deo e/ou dados
																	biogr&aacute;ficos em todo e qualquer material entre fotos, dados e outros meios de
																	comunica&ccedil;&atilde;o, para serem utilizados no <?php echo SIS_TITULO?>, por meio dos an&uacute;ncios, sejam esses destinados &agrave; divulga&ccedil;&atilde;o ao p&uacute;blico adulto e/ou apenas para
																	uso interno para avalia&ccedil;&atilde;o de autenticidade, desde que n&atilde;o haja desvirtuamento da sua finalidade. </p>
                                         </h6>
                                         <div class="row"> 
                                           <div class="col-sm-12">                                                                                          
                                                <div class="form-group">
                                                    <input type="checkbox" id="aceite" name="aceite" data-error="Voc&ecirc; deve estar de acordo com os Termos de Uso do site antes de publicar seu an&uacute;ncio!" required> <strong>ESTOU DE ACORDO! QUERO PUBLICAR MEU DEPOIMENTO</strong>
                                                    <div class="help-block with-errors"></div>
                                                </div> 
                                            </div>
                                         </div> 
                                         
                                         <hr/>                        
                                         
                                         <?php 
                                         		if ($personID != '0' && !$_SESSION['sUserLogged'])
                                         		{
                                         			echo $functions->fGetPersonTestimonialsToApprove($personID); 
                                         		}
                                           ?>
                                              
                                         <?php if ($_SESSION['sUserLogged']){ ?>                           	  
	                                         <h4><i class="fa fa-comment"></i> Depoimento para <?php echo $retPerson[0]['apelido'];?></h4>
	                                         <div class="row">                                         	                                     
		                                            <div class="col-sm-12">                                                                                          
		                                                <div class="form-group">
		                                                    <label>T&iacute;tulo do seu Depoimento *</label>                                                    
		                                                    <input type="text" id="titulo" name="titulo" data-error="Por favor, informe o T&iacute;tulo do seu depoimento!" required class="form-control titulo" maxlength="40">
		                                                    <div class="help-block with-errors titulo"></div>
		                                                </div> 
		                                            </div>
		                                            <div class="col-sm-12">
		                                                <div class="form-group">
		                                                    <label>Descreva um texto sobre seu depoimento *</label>
		                                                    <textarea id="descricao" name="descricao" data-minlength="10" data-error="Por favor, informe a Descri&ccedil;&atilde;o do seu depoimento!" required class="form-control" rows="6"></textarea>
		                                                    <div class="help-block with-errors descricao"></div>
		                                                </div>	                                                
		                                            </div>	   		                                            	                                               
	                                         </div> 	                                                                               
	                                         <div class="row">                                           	
	                                            <div class="col-sm-12 direita">
	                                            	<input type="hidden" name="pesid" id="pesid" value="<?php echo $personID; ?>">  
	                                            	<a href="<?php echo SIS_URL; ?>dashboard" class="btn btn-warning m-top-30">Cancelar <i class="fa fa-remove"></i></a>                                              
	                                                <button type="submit" class="btn btn-primary m-top-30">Salvar <i class="fa fa-check"></i></button>                                                
	                                            </div>                                                                                        
	                                         </div>
                                         <?php } ?> 
                                           
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
        <script src="<?php echo SIS_URL; ?>assets/js/hotels.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0EgJjuN8-iBhgg8EMg2gjip6jRQSoTXs&libraries=places&callback=initMap" async defer></script>
        <script type="text/javascript">
			$(".multiple-select").select2({
				placeholder: "Informe ao menos um item!"
			});
			
			$(".modalidade").select2({
				placeholder: "Informe ao menos uma modalidade que realiza!"
			});

			$(".localidade").select2({
				placeholder: "Informe ao menos uma localidade onde atende!"
			});

			$('.active-ad').on('click', function(){	
				if (!$(this).is(':checked')) {
					if (confirm('Desmarcando esta op\u00e7\u00e3o, seu an\u00fancio n\u00e3o aparecer\u00e1 no portal, at\u00e9 que o mesmo seja ativado novamente. Deseja mesmo desativar?')) {
						$(this).attr('checked', false);
					}else{
						$(this).prop('checked', true);
					}
				}		
			});
			
			$('.money').mask("#.##0", {reverse: true});

			$('.cancel').on('click', function(){
				if(confirm('Todas as altera\u00e7oes n\u00e3o gravadas ser\u00e3o perdidas! Deseja continuar?'))
				{
					location.href = '<?php echo SIS_URL; ?>';
				}				
			});
		</script>
    </body>
</html>