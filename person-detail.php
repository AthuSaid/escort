<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
	
	session_start2();
    
    $functions = new functions();  

    $logged = ($_SESSION['sPersonLogged'] && $_SESSION['sPersonUrl'] == $_GET['person'] ? true : false);
        
    $retPerson = $functions->fGetAdPersonDetails($_GET['person'], $_GET['ad']);
    
    if (count($retPerson) == 0 || $retPerson[0]['vencimento'] < 0)
    {
    	header('Location: '.SIS_URL.'persons');    	
    	exit;
    }
    
    $countPhotos = $functions->fGetCountPersonPhotos($retPerson[0]['pesid']);
    
    $countVideos = $functions->fGetCountPersonVideos($retPerson[0]['pesid']);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - <?php echo $retPerson[0]['apelido']; ?></title>
        <meta name="description" content="<?php echo SIS_TITULO; ?> - <?php echo $retPerson[0]['apelido']; ?> - <?php echo ucwords(strip_tags($retPerson[0]['titulo'])); ?> - <?php echo str_replace("\n", "", $functions->fStripTagsContent($retPerson[0]['descricao'])); ?>">
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
		<link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/recorder.css">
		
        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->
        <!--Theme custom css -->
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/style.css">  
        <link rel="stylesheet" href="<?php echo SIS_URL; ?>assets/css/cover.php">      
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
            <div class="container openmodal" data-modal="landscape" id="cropImgLandscape">											    
				  <!-- Cropping modal -->
				    <div class="modal fade" id="landscapeModal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
				      <div class="modal-dialog modal-lg">
				        <div class="modal-content">
				          <form class="avatar-form" action="<?php echo SIS_URL;?>images/procimg/crop.php" enctype="multipart/form-data" method="post">
				            <div class="modal-header">
				              <button type="button" class="close" data-dismiss="modal">&times;</button>
				              <h4 class="modal-title">Inserir Foto de Capa</h4>
				            </div>
				            <div class="modal-body">
				              <div class="avatar-body">
				                <div class="avatar-upload">
				                  <input type="hidden" class="avatar-src" name="avatar_src">
				                  <input type="hidden" class="avatar-data" name="avatar_data">
								  <input type="hidden" value="<?php echo $retPerson[0]['apid'];?>" name="apid">
				                  <input type="hidden" value="<?php echo $_SESSION['sPersonUrl'];?>" name="person_url">
				                  <input type="hidden" value="landscape" name="imgtype">				                  
				                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
				                </div>
				                <div class="row">
				                  <div class="col-md-9">
				                    <div class="avatar-wrapper"></div>
				                  </div>
 			                   </div>				                			
				                <div class="row avatar-btns">
				                  <div class="col-md-12">
				                    <div class="btn-group">
				                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30" title="Girar 30 Graus Antihorario"><i class="fa fa-rotate-left"></i></button>
				                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30" title="Girar 30 Graus Horario"><i class="fa fa-rotate-right"></i></button>
				                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.03" title="Mais Zoom"><i class="fa fa-search-plus"></i></button>
   								      <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.03" title="Menos Zoom"><i class="fa fa-search-minus"></i></button>
				                    </div>
				                  </div>
				                </div>
				                <div class="row avatar-btns">  
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
            
            	<?php if ($logged) { ?>
            		<div class="divChangeMediasLandscape land" ><i class="fa fa-camera"></i> Alterar Foto</div>							    	
            	<?php } ?>
            	<div class="imgLandscapeModel style-<?php echo $retPerson[0]['person'].$retPerson[0]['ad']; ?> bg-mega">                            			
	                <div class="container">
	                    <div class="row">	                    	
	                        <div class="main_home text-center">	                        
	                            <div class="model_text">	                            
                                <h1 class="text-white text-uppercase shadow-text"><?php echo $retPerson[0]['apelido']; ?></h1>
                                <h3 class="text-white shadow-text"><?php echo $retPerson[0]['titulo']; ?></h3>                                
                                <ol class="breadcrumb text-uppercase">
                                    <li class="shadow-text"><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <?php if ($logged) { ?>
                                    	<li class="shadow-text"><a href="<?php echo SIS_URL; ?>dashboard">Minha Conta</a></li>
                                    <?php }else{ ?>
                                    	<li class="shadow-text"><a href="<?php echo SIS_URL; ?>persons">Novas Pessoas</a></li>
                                    <?php } ?>
                                    <li class="active shadow-text"><a href="<?php echo SIS_URL.'person/'.$retPerson[0]['person'].'/'.$retPerson[0]['ad']; ?>"><?php echo $retPerson[0]['apelido']; ?></a></li>
                                </ol>
                                
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
								              <h4 class="modal-title" id="avatar-modal-label">Inserir Foto Poster</h4>
								            </div>
								            <div class="modal-body">
								              <div class="avatar-body">
								                <div id="fileupload" class="avatar-upload">
								                  <input type="hidden" class="avatar-src" name="avatar_src">
								                  <input type="hidden" class="avatar-data" name="avatar_data">
								                  <input type="hidden" value="<?php echo $retPerson[0]['apid'];?>" name="apid">								                  
								                  <input type="hidden" value="<?php echo $_SESSION['sPersonUrl'];?>" name="person_url">
												  <input type="hidden" value="portrait" name="imgtype">								                  
								                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
								                </div>			
								                <div class="row">
								                  <div class="col-md-9">
								                    <div id="cropper" class="avatar-wrapper"></div>
								                    <!--div id="webcam" class="divCropperCamera"></div-->								                    
								                  </div>
								                  <!--div class="col-md-3">
								                    <div class="avatar-preview preview-lg"></div>			                    
								                  </div-->
								                </div>			
								                <div class="row avatar-btns">
								                  <div class="col-md-12">
								                    <div class="btn-group">
								                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30" title="Girar 30 Graus Antihorario"><i class="fa fa-rotate-left"></i></button>
								                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30" title="Girar 30 Graus Horario"><i class="fa fa-rotate-right"></i></button>
								                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.03" title="Mais Zoom"><i class="fa fa-search-plus"></i></button>
   								                      <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.03" title="Menos Zoom"><i class="fa fa-search-minus"></i></button>
								                      <!--button type="button" id="show-camera" class="btn btn-primary" title="Tirar Foto"><i class="fa fa-user-o"></i></button>
								                      <button type="button" id="popup-webcam-take-photo" disabled="disabled" class="btn btn-warning shot"><i class="fa fa-camera"></i></button-->
								                    </div>
								                  </div>
								                </div>
								                <div class="row avatar-btns">  
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
                                            <?php if($retPerson[0]['peso'] != ''){ ?>                                            
                                            	<p>Peso:</p>
                                            <?php }if($retPerson[0]['altura'] != ''){ ?>
                                            	<p>Altura:</p>                                            
                                            <?php } if ($retPerson[0]['sexo'] == 'F') {?>
                                            	<?php if ($retPerson[0]['busto'] != '' || $retPerson[0]['cintura'] != '' || $retPerson[0]['quadril'] != '') {?>
                                            		<p>Medidas:</p>
                                            	<?php } ?>
                                            <?php }else{ ?>
                                            	<p>Dote:</p>
                                            <?php } ?>
                                            <p>&nbsp;</p>	                                                                                       
                                        </div>
                                        <div class="col-md-5 text-left2">                                            
                                            <p><strong><?php echo $functions->fGetGenderPerson($retPerson[0]['sexo']); ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['pessoasatendimento']; ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['etnia']; ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['olhos']; ?></strong></p>
                                            <p><strong><?php echo $retPerson[0]['cabelos']; ?></strong></p>
                                            <p><strong><?php echo $functions->fGetAge($retPerson[0]['nascimento']); ?></strong></p>
                                            <?php if($retPerson[0]['peso'] != ''){ ?>
                                            	<p><strong><?php echo $retPerson[0]['peso']; ?> kg</strong></p>
                                            <?php }if($retPerson[0]['altura'] != ''){ ?>
                                            	<p><strong><?php echo $retPerson[0]['altura']; ?> m</strong></p>
                                            <?php } if ($retPerson[0]['sexo'] == 'F') {?>                                            	
                                            	<p><strong><?php echo ($retPerson[0]['busto'] != '' ? 'Busto: '.$retPerson[0]['busto'] : '').($retPerson[0]['cintura'] != '' ? ' Cintura: '.$retPerson[0]['cintura'] : '').($retPerson[0]['quadril'] != '' ? ' Quadril: '.$retPerson[0]['quadril'] : ''); ?></strong></p>
                                            <?php }else{ ?>	
                                            	<p><strong><?php echo $retPerson[0]['pcm']; ?> cm</strong></p>
                                            <?php } ?>                                                                                       
                                            <p><strong><?php echo ($retPerson[0]['localproprio'] == 1 ? 'POSSUO LOCAL PR&Oacute;PRIO!' : ''); ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                                 <hr />
                                 
                                 <?php if ($retPerson[0]['fake'] != 1){ ?>
                                 	<?php if (!empty($retPerson[0]['whatsapp'])){ ?>                                 	
	                                 	<?php $userAgent = $_SERVER['HTTP_USER_AGENT'];							                                	
			                                	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent) || 
			                                       preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent,0,4))){
			                                       	$urlWhatsApp = "intent://send/".$functions->fRemoveNumFormat($retPerson[0]['whatsapp'])."#Intent;scheme=smsto;package=com.whatsapp;action=android.intent.action.SENDTO;end";
			                                	}else{
			                                		$urlWhatsApp = "tel:".$functions->fRemoveNumFormat($retPerson[0]['whatsapp']);
			                                	}							             
		                                ?>
                                		<h4><i class="fa fa-whatsapp"></i> <a href="<?php echo $urlWhatsApp; ?>"><?php echo $retPerson[0]['whatsapp']; ?></a></h4>
                                	<?php } if (!empty($retPerson[0]['tel1'])){ ?>
                                		<h4> <i class="fa fa-phone"></i> <a href="tel:<?php echo $functions->fRemoveNumFormat($retPerson[0]['tel1']); ?>"><?php echo $retPerson[0]['tel1']; ?></a></h4>
                                	<?php } if (!empty($retPerson[0]['tel2'])){ ?>
                                		<h4> <i class="fa fa-phone"></i> <a href="tel:<?php echo $functions->fRemoveNumFormat($retPerson[0]['tel2']); ?>"><?php echo $retPerson[0]['tel2']; ?></a></h4>
                                	<?php } if (!empty($retPerson[0]['facebook'])){ ?>
                                		<h6> <i class="fa fa-facebook"></i> <a href="<?php echo $retPerson[0]['facebook']; ?>" target="_blank">Visite meu Facebook</a></h6>
                                	<?php } if (!empty($retPerson[0]['twitter'])){ ?>
                                		<h6> <i class="fa fa-twitter"></i> <a href="<?php echo $retPerson[0]['twitter']; ?>" target="_blank">@<?php echo $retPerson[0]['url']; ?></a></h6>
                                	<?php } if (!empty($retPerson[0]['googleplus'])){ ?>
                                		<h6> <i class="fa fa-instagram"></i> <a href="<?php echo $retPerson[0]['googleplus']; ?>" target="_blank"><?php echo ucwords($retPerson[0]['apelido']); ?></a></h6>
                                <?php }} ?>
                                	
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
                                	
                                	<?php if ($retPerson[0]['atendimento24H'] == 1){ ?>
                                			<h6><strong>ATENDIMENTO 24 HORAS!</strong></h6>
                                	<?php }else{ ?>
	                                	<?php if ($retPerson[0]['diahoraatendimentoutil'] != '0-0-99-99'){ ?>                                	
	                                		<h6><strong><?php echo $functions->fFormatDayHourWork($retPerson[0]['diahoraatendimentoutil'], true); ?></strong></h6>
	                                	<?php } ?>
	                                	<?php if ($retPerson[0]['diahoraatendimentofds'] != '0-0-99-99'){ ?>
	                                		<h6><strong><?php echo $functions->fFormatDayHourWork($retPerson[0]['diahoraatendimentofds'], false); ?></strong></h6>
	                                	<?php } ?>
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
            <?php echo $functions->fCreateUserTestimonials($retPerson[0]['pesid']); ?>


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
           						<?php echo $functions->fGetPersonPhotos($retPerson[0]['apid'], $retPerson[0]['url'], $countPhotos, $countVideos); ?>


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
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.ui.js"</script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
	    <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>	    		
        <script src="<?php echo SIS_URL; ?>assets/js/fake.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery.balloon.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/counter.js"></script>               
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyB0EgJjuN8-iBhgg8EMg2gjip6jRQSoTXs"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/gmaps.min.js"></script>                
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>        
        <script src="<?php echo SIS_URL; ?>assets/js/cropper.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/croppermain.js"></script> 
        <?php if ($logged) { ?>
	        <!--script type="text/javascript" src="<?php echo SIS_URL; ?>assets/webcam/webcam.poster.js"></script-->      
	        <script type="text/javascript" src="<?php echo SIS_URL; ?>assets/webcam/webcam.gallery.js"></script>
	        <script type="text/javascript" src="<?php echo SIS_URL; ?>assets/js/recorder.js"></script>
        <?php } ?>
        <script type="text/javascript">
        	<?php echo $functions->fGetPersonModalitiesBalloonTip($retPerson[0]['apid'], $retPerson[0]['sexo']); ?>            
		</script>         
                
	    <?php echo $functions->fGetPersonLocations($retPerson, 1); ?>      
	    
	    <!-- UPDATE VISIT COUNT ################################### -->
        <?php $functions->fUpdateVisitCount($retPerson[0]['apid']); ?>  	                
    </body>
</html>