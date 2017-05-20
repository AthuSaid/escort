<?php
    session_start();
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  

    $logged = ($_SESSION['sPersonLogged'] && $_SESSION['sPersonUrl'] == $_GET['person'] ? true : false);
        
    $retPerson = $functions->fGetAdPersonDetails($_GET['person'], $_GET['ad']);
    
    if (count($retPerson) == 0 || $retPerson[0]['vencimento'] < 0)
    {
    	header('Location: '.SIS_URL.'persons');    	
    	exit;
    }
    
    $countPhotos = $functions->fGetCountPersonPhotos($retPerson[0]['pesid']);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - <?php echo $retPerson[0]['apelido']; ?></title>
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
		<link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/croppic.css">        	
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/main.css">        
        
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/cropper.css">
		<link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/croppermain.css">
		
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
            <div class="container openmodal" data-modal="landscape" id="cropImgLandscape">											    
				  <!-- Cropping modal -->
				    <div class="modal fade" id="landscapeModal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
				      <div class="modal-dialog modal-lg">
				        <div class="modal-content">
				          <form class="avatar-form" action="<?php echo SIS_URL;?>images/procimg/crop.php" enctype="multipart/form-data" method="post">
				            <div class="modal-header">
				              <button type="button" class="close" data-dismiss="modal">&times;</button>
				              <h4 class="modal-title">Carregar M&iacute;dia no Site - Foto Chamativa</h4>
				            </div>
				            <div class="modal-body">
				              <div class="avatar-body">
				                <div class="avatar-upload">
				                  <input type="hidden" class="avatar-src" name="avatar_src">
				                  <input type="hidden" class="avatar-data" name="avatar_data">
								  <input type="hidden" value="<?php echo $retPerson[0]['apid'];?>" name="apid">
				                  <input type="hidden" value="<?php echo $_SESSION['sPersonUrl'];?>" name="person_url">
				                  <input type="hidden" value="landscape" name="imgtype">
				                  <label for="avatarInput">Selecione o Arquivo para Upload:</label>
				                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
				                </div>
				                <div class="row">
				                  <div class="col-md-9">
				                    <div class="avatar-wrapper"></div>
				                  </div>
 			                   </div>				                			
				                <div class="row avatar-btns">
				                  <div class="col-md-9">
				                    <div class="btn-group">
				                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30" title="Girar 30 Graus Antihorario"><i class="fa fa-rotate-left"></i></button>
				                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30" title="Girar 30 Graus Horario"><i class="fa fa-rotate-right"></i></button>
				                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.03" title="Mais Zoom"><i class="fa fa-search-plus"></i></button>
   								      <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.03" title="Menos Zoom"><i class="fa fa-search-minus"></i></button>
				                    </div>
				                  </div>
				                  <div class="col-md-3">
				                    <button type="submit" class="btn btn-warning btn-block avatar-save">Salvar</button>
				                  </div>
				                </div>
				              </div>
				            </div>
				          </form>
				        </div>
				      </div>
				    </div>			    
				  </div>
            
            	<div class="imgLandscapeModel" class="bg-mega" style="background: url('<?php echo SIS_URL.'images/persons/'.$retPerson[0]['person'].'/'.$retPerson[0]['cover']; ?>') no-repeat bottom center;">                            			
	                <div class="container">
	                    <div class="row">
	                        <div class="main_home text-center">
	                            <div class="model_text">
                                <h1 class="text-white text-uppercase shadow-text"><?php echo $retPerson[0]['apelido']; ?></h1>
                                <h3 class="text-white text-uppercase shadow-text"><?php echo $retPerson[0]['titulo']; ?></h3>                                
                                <ol class="breadcrumb text-uppercase">
                                    <li class="shadow-text"><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li class="shadow-text"><a href="<?php echo SIS_URL; ?>dashboard">Minha Conta</a></li>
                                    <li class="active shadow-text"><a href="<?php echo SIS_URL.'person/'.$retPerson[0]['person'].'/'.$retPerson[0]['ad']; ?>"><?php echo $retPerson[0]['apelido']; ?></a></li>
                                </ol>
                                <?php if ($logged) { ?>
			            			<div class="divChangeMediasLandscape centerLand land" ><i class="fa fa-camera"></i> Alterar Foto</div>							    	
			            		<?php } ?>
                            </div>
	                        </div>
	                    </div><!--End off row-->
	                </div><!--End off container -->
	            </div> <!--End off Home Sections-->
            </div> <!--End off Home Sections-->

            <!--Model Details Section-->
            <section id="m_details" class="m_details roomy-200 fix">
                <div class="container">
                    <div class="row">
                        <div class="main_details">
                            <div class="col-md-6">
                            
								<div class="m_details_img">
								    <?php if ($logged) { ?>	
										<div class="divChangeMedias port"><i class="fa fa-camera"></i> Alterar Foto</div>							    	
									<?php } ?>	
								   	<div class="imgPortraitModel" style="background: url('<?php echo SIS_URL; ?>images/persons/<?php echo $retPerson[0]['url']; ?>/<?php echo $retPerson[0]['thumb']; ?>') no-repeat bottom center; border: 5px solid #550000; max-width:555px; "></div>									    
							    </div>
                            
                            	<div class="container openmodal" data-modal="portrait" id="cropImgPortrait">											    
								    <!-- Cropping modal -->
								    <div class="modal fade" id="portraitModal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
								      <div class="modal-dialog modal-lg">
								        <div class="modal-content">
								          <form class="avatar-form" action="<?php echo SIS_URL;?>images/procimg/crop.php" enctype="multipart/form-data" method="post">
								            <div class="modal-header">
								              <button type="button" class="close" data-dismiss="modal">&times;</button>
								              <h4 class="modal-title" id="avatar-modal-label">Carregar M&iacute;dia no Site - Poster</h4>
								            </div>
								            <div class="modal-body">
								              <div class="avatar-body">
								                <div id="fileupload" class="avatar-upload">
								                  <input type="hidden" class="avatar-src" name="avatar_src">
								                  <input type="hidden" class="avatar-data" name="avatar_data">
								                  <input type="hidden" value="<?php echo $retPerson[0]['apid'];?>" name="apid">								                  
								                  <input type="hidden" value="<?php echo $_SESSION['sPersonUrl'];?>" name="person_url">
												  <input type="hidden" value="portrait" name="imgtype">
								                  <label for="avatarInput">Selecione o Arquivo para Upload:</label>
								                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
								                </div>			
								                <div class="row">
								                  <div class="col-md-9">
								                    <div id="cropper" class="avatar-wrapper"></div>
								                    <!--div id="webcam" class="divCropperCamera"></div-->								                    
								                  </div>
								                  <div class="col-md-3">
								                    <div class="avatar-preview preview-lg"></div>			                    
								                  </div>
								                </div>			
								                <div class="row avatar-btns">
								                  <div class="col-md-9">
								                    <div class="btn-group">
								                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30" title="Girar 30 Graus Antihorario"><i class="fa fa-rotate-left"></i></button>
								                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30" title="Girar 30 Graus Horario"><i class="fa fa-rotate-right"></i></button>
								                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.03" title="Mais Zoom"><i class="fa fa-search-plus"></i></button>
   								                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.03" title="Menos Zoom"><i class="fa fa-search-minus"></i></button>
								                      <!--button type="button" id="show-camera" class="btn btn-primary" title="Tirar Foto"><i class="fa fa-user-o"></i></button>
								                      <button type="button" id="popup-webcam-take-photo" disabled="disabled" class="btn btn-warning shot"><i class="fa fa-camera"></i></button-->
								                    </div>
								                  </div>
								                  <div class="col-md-3">
								                    <button type="submit" class="btn btn-warning btn-block avatar-save">Salvar</button>
								                  </div>
								                </div>
								              </div>
								            </div>
								          </form>
								        </div>
								      </div>
								    </div>			    
								  </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="m_details_content m-bottom-40">
                                    <h2><?php echo $retPerson[0]['apelido']; ?></h2>
                                    <h6>Nasci em <?php echo $retPerson[0]['naturalidade']; ?></h6>
                                    <h5>Meu perfil foi visitado <strong><?php echo $retPerson[0]['visitascount']; ?></strong> vezes</h5>                                    
                                    <hr/>
                                    <!--p><?php //echo nl2br($retPerson[0]['descricao']); ?></p-->                                    
                                </div>                               
                                <div class="person_details m-top-40">
                                    <div class="row">                                    
                                        <div class="col-md-4 text-left2">    
                                        	<p>Eu sou:</p>
                                        	<p>Atendo:</p>
                                        	<p>Etnia:</p>                                        
                                            <p>Olhos:</p>
                                            <p>Cabelos:</p>
                                            <p>Idade:</p>                                            
                                            <p>Peso:</p>
                                            <p>Altura:</p>                                            
                                            <?php if ($retPerson[0]['sexo'] == 'F') {?>
                                            	<?php if ($retPerson[0]['busto'] != '' || $retPerson[0]['cintura'] != '' || $retPerson[0]['quadril'] != '') {?>
                                            		<p>Medidas:</p>
                                            	<?php } ?>
                                            <?php }else{ ?>
                                            	<p>Dote:</p>
                                            <?php } ?>
                                            <p>Possuo Local Pr&oacute;prio?</p>	                                                                                       
                                        </div>
                                        <div class="col-md-5 text-left2">                                            
                                            <p><strong><?php echo $functions->fGetGenderPerson($retPerson[0]['sexo']); ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['pessoasatendimento']; ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['etnia']; ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['olhos']; ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['cabelos']; ?></strong></p>
                                            <p><strong><?php echo $functions->fGetAge($retPerson[0]['nascimento']); ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['peso']; ?> kg</strong></p>
                                            <p><strong><?php echo $retPerson[0]['altura']; ?> m</strong></p>
                                            <?php if ($retPerson[0]['sexo'] == 'F') {?>                                            	
                                            	<p><strong><?php echo ($retPerson[0]['busto'] != '' ? 'Busto: '.$retPerson[0]['busto'] : '').($retPerson[0]['cintura'] != '' ? ' Cintura: '.$retPerson[0]['cintura'] : '').($retPerson[0]['quadril'] != '' ? ' Quadril: '.$retPerson[0]['quadril'] : ''); ?></strong></p>
                                            <?php }else{ ?>	
                                            	<p><strong><?php echo $retPerson[0]['pcm']; ?> cm</strong></p>
                                            <?php } ?>                                                                                       
                                            <p><strong><?php echo ($retPerson[0]['localproprio'] == 1 ? 'SIM' : 'N&Atilde;O'); ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                                 <hr />
                                 
                                 	<?php if (!empty($retPerson[0]['whatsapp'])){ ?>
                                		<h4><i class="fa fa-whatsapp"></i> <?php echo $retPerson[0]['whatsapp']; ?></h4>
                                	<?php } if (!empty($retPerson[0]['tel1'])){ ?>
                                		<h4> <i class="fa fa-phone"></i> <?php echo $retPerson[0]['tel1']; ?></h4>
                                	<?php } if (!empty($retPerson[0]['tel2'])){ ?>
                                		<h4> <i class="fa fa-phone"></i> <?php echo $retPerson[0]['tel2']; ?></h4>
                                	<?php } if (!empty($retPerson[0]['facebook'])){ ?>
                                		<h6> <i class="fa fa-facebook"></i> <a href="<?php echo $retPerson[0]['facebook']; ?>" target="_blank">Visite meu Facebook</a></h6>
                                	<?php } if (!empty($retPerson[0]['twitter'])){ ?>
                                		<h6> <i class="fa fa-twitter"></i> <a href="<?php echo $retPerson[0]['twitter']; ?>" target="_blank">@<?php echo $retPerson[0]['url']; ?></a></h6>
                                	<?php } if (!empty($retPerson[0]['googleplus'])){ ?>
                                		<h6> <i class="fa fa-instagram"></i> <a href="<?php echo $retPerson[0]['googleplus']; ?>" target="_blank"><?php echo ucwords($retPerson[0]['apelido']); ?></a></h6>
                                	<?php } ?>
                                	
                                	<?php /* ###### DESATIVADO ATE O FATURAMENTO FAZER VALER A PENA INVESTIR!! #####
                                	if ($retPerson[0]['ppv'] == 1){ ?>
                                		<h4>
                                		
	                                		<?php if ($retPerson[0]['ppv_online'] != 1){ ?>
	                                			<i class="fa fa-video-camera"></i> PPV Offline
	                                		<?php }else{ ?>	 
	                                			<a href="#" target="_blank" class="btn btn-ppv-<?php echo strtolower($retPerson[0]['sexo']); ?> text-uppercase"><i class="fa fa-video-camera"></i> PPV Online!</a>
	                                		<?php } ?>
	                                			
                               			</h4>
                                	<?php }*/ ?>
                                	 
                                	<hr /> 
                                	
                                	<?php if (!empty($retPerson[0]['diahoraatendimentoutil'])){ ?>                                	
                                		<h6><strong><?php echo $retPerson[0]['diahoraatendimentoutil']; ?></strong></h6>
                                	<?php } ?>
                                	<?php if (!empty($retPerson[0]['diahoraatendimentofds'])){ ?>
                                		<h6><strong><?php echo $retPerson[0]['diahoraatendimentofds']; ?></strong></h6>
                                	<?php } ?>
                                	
                                	<h5><em>Ao entrar em contato comigo, diga que foi atrav&eacute;s do site <?php echo SIS_TITULO; ?></em></h5>                                	
                                	
                                <hr />
                            </div>


							<div class="col-md-12">
                                <div class="skill_bar m-top-40">    
                                    <div class="row">
                                         <div class="col-md-12 m-bottom-40">
			                                <div class="head_title text-left sm-text-center wow fadeInDown">
			                                    <h3><?php echo ucwords(strip_tags($retPerson[0]['titulo'])); ?></h3>
			                                    <h5 class="overflw22"><em><?php echo nl2br($functions->fStripTagsContent($retPerson[0]['descricao'])); ?></em></h5>			                                    
			                                </div>
			                            </div>			                            
                                    </div>
                                </div>
                            </div>


							
                            <div class="col-md-12">
                            	<hr />
                                <div class="skill_bar m-top-40">    
                                    <div class="row">
                                         <div class="col-md-12 m-bottom-40">
			                                <div class="head_title text-left sm-text-center wow fadeInDown">
			                                    <h3>Minhas Especialidades</h3>
			                                    <h5><em>Sou profissional e realizo as seguintes modalidades:</em></h5>			                                    
			                                </div>
			                            </div>
			                            <div style="clear: both;"></div>                                       
                                        
                                        <!-- SERVICES DESCRIPTION  - PERSON MODALITIES ######################################### -->
            							<?php echo $functions->fGetPersonModalities($retPerson[0]['apid'], $retPerson[0]['sexo']); ?>                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                           	    <hr />
                                <div class="skill_bar m-top-40">    
                                    <div class="row">
                                         <div class="col-md-12 m-bottom-40">
			                                <div class="head_title text-left sm-text-center wow fadeInDown">
			                                    <h3>Valores dos meus Servi&ccedil;os</h3>
			                                    <h5><em>Pague diretamente &agrave; mim pelo tempo do servi&ccedil;o que deseja contratar!
			                                    <?php echo ($retPerson[0]['moeda'] != 'R$' ? "<br>Aten&ccedil;&atilde;o, os servi&ccedil;os realizados por ".$functions->fReduceName($retPerson[0]['apelido'])." s&atilde;o cobrados em ".$retPerson[0]['moeda'] : ""); ?>
			                                    </em></h5>
			                                </div>
			                            </div>			                                                                  
                                       
                                        <!-- PRICE SERVICES   - PERSON CACHE ######################################################################### -->
            							<?php echo $functions->fGetPersonCache($retPerson[0]['apid'], $retPerson[0]['sexo'], $retPerson[0]['moeda']); ?>                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                            <?php echo $functions->fGetPersonLocations($retPerson, 2); ?>
			                                    	 	

                        </div>
                    </div><!-- End off row -->
                </div> <!-- End off container -->
            </section> <!-- End off Model Details Section -->


            <!-- TESTEMUNHAS DE USUARIOS QUE JA CONHECERAM A PESSOA ################### -->
            <?php //echo $functions->fCreateUserTestimonials($retPerson[0]['pesid']); ?>


            <!--Gallery Section-->
            <section id="gallery" class="gallery margin-top-120 bg-grey">
                <!-- Gallery container-->
                <div class="container">
                    <div class="row">
                        <div class="main-gallery roomy-80">
                            <div class="col-md-12 m-bottom-40">
                                <div class="head_title text-left sm-text-center wow fadeInDown">
                                    <h3>Meu Ensaio Fotogr&aacute;fico</h3>
                                    <h5><em>Confira a minha galeria de fotos profissionais.</em></h5>                                    
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="grid text-center">
                            
                            
                                <!-- PERSON GALLERY ########################################### -->
           						<?php echo $functions->fGetPersonPhotos($retPerson[0]['apid'], $retPerson[0]['url']); ?>


                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div><!-- Portfolio container end -->
            </section><!-- End off portfolio section -->


            <!-- scroll up-->
            <div class="scrollup">
                <a href="#"><i class="fa fa-chevron-up"></i></a>
            </div><!-- End off scroll up -->


            <!-- MENU DE NAVEGACAO - FOOTER -->
            <?php require_once '_requires/footer.php'; ?>

        </div>

        <!-- JS includes -->
        <script>var $urlProj = '<?php echo SIS_URL; ?>';
		        var cropperFileUpload;
        </script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo SIS_URL; ?>assets/webcam/jquery.webcam.as3.js"></script>
                
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/isotope.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.easing.1.3.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/slick.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
	    <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>	    		
        <script src="<?php echo SIS_URL; ?>assets/js/fake.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery.balloon.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/counter.js"></script>               
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyD_tAQD36pKp9v4at5AnpGbvBUsLCOSJx8"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/gmaps.min.js"></script>                
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/cropper.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/croppermain.js"></script> 
        <!--script type="text/javascript" src="<?php echo SIS_URL; ?>assets/webcam/webcam.poster.js"></script-->      
        <script type="text/javascript" src="<?php echo SIS_URL; ?>assets/webcam/webcam.gallery.js"></script>
        
        <script type="text/javascript">
        	<?php echo $functions->fGetPersonModalitiesBalloonTip($retPerson[0]['apid'], $retPerson[0]['sexo']); ?>            
		</script>         
                
	    <?php echo $functions->fGetPersonLocations($retPerson, 1); ?>      
	    
	    <!-- UPDATE VISIT COUNT ################################### -->
        <?php $functions->fUpdateVisitCount($retPerson[0]['apid']); ?>  	                
    </body>
</html>