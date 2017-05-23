<?php
    session_start();
        
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  
    
    if ($_SESSION['sPersonLogged'])
    {
    	if (isset($_GET['person']) && isset($_GET['ad']) && $_SESSION['sPersonUrl'] == $_GET['person'])
    	{    	
    		$retAd = $functions->fEditPersonAd($_GET['person'], $_GET['ad']);
    	
    		$countAds = $functions->fGetCountDashboardAds($_SESSION['sPersonID']);
    		
    		if (count($retAd) == 0 && ($countAds >= $_SESSION['sPersonMaxAds'] || $_SESSION['sPersonPlanExpires'] < 0 || $_SESSION['sPersonPlanPaid'] < 1))
    		{
    			header('Location: '.SIS_URL.'dashboard');
    			exit;
    		}	    		
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
        <title><?php echo SIS_TITULO; ?> - Novo An&uacute;ncio</title>
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
            <section id="hello" class="blog-banner bg-mega">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="about_text">
                                <h1 class="text-white text-uppercase">Seu An&uacute;ncio</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li><a href="<?php echo SIS_URL; ?>dashboard">Dashboard</a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?>ad">Seu An&uacute;ncio</a></li>
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
                                
                                <form method="post" role="form" name="form-ad" id="form-ad" data-toggle="validator">
                                         
                                        <h4> 
                                            <p><strong><i class="fa fa-warning"></i> REGRAS PARA PUBLICA&Ccedil;&Atilde;O DO SEU AN&Uacute;NCIO</strong></p>
										</h4>	
										<h6>	
											<p>An&uacute;ncio restrito apenas para maiores de <strong>18 ANOS</strong>, respeitando as seguintes imposi&ccedil;&otilde;es:</p>											
											<p><strong>a.</strong> Todas as informa&ccedil;&otilde;es contidas no(s) seu(s) an&uacute;ncio(s) devem serem VERDADEIRAS bem como sua identidade e o prop&oacute;sito do mesmo.</p>
											<p><strong>b.</strong> S&oacute; &eacute; permitido imagens de semi-nudez, onde a regi&atilde;o genital DEVE estar completamente coberta.</p> 
											<p><strong>c.</strong> &Eacute; expressamente <strong>PROIBIDO</strong> inserir contendo sexo expl&iacute;cito em seu(s) an&uacute;ncio(s)! As imagens devem conter somente a divulga&ccedil;&atilde;o da(o)(s) acompanhante(s), exibindo seu(s) f&iacute;sico(s), cobrindo a regi&atilde;o genital. Em caso de d&uacute;vidas, contate nosso apoio no email anuncio@escort.com.</p> 
											<p><strong>d.</strong> Ao adicionar seu an&uacute;ncio, voc&ecirc; estar&aacute; concordando com nossos <a href="<?php echo SIS_URL; ?>privacy" target="_blank">Termos de Uso</a>.</p> 
											<p><strong>e.</strong> Marcando a op&ccedil;&atilde;o <strong>'ESTOU DE ACORDO! QUERO PUBLICAR MEU AN&Uacute;NCIO'</strong> abaixo, voc&ecirc; concorda no fato de que o <?php echo SIS_TITULO; ?> n&atilde;o tem uso, participa&ccedil;&atilde;o ou co-participa&ccedil;&atilde;o no(s) seu(s) an&uacute;ncio(s) publicado(s) no site, e tamb&eacute;m, voc&ecirc; concorda que o site <?php echo SIS_TITULO; ?> tem o livre direito de apagar o(s) an&uacute;ncio(s) e banir sua conta de usu&aacute;rio, caso venha a infringir os Termos de Uso.</p>
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
                                         <h4><i class="fa fa-id-card"></i> Seu An&uacute;ncio</h4>
                                         <div class="row">                                         
	                                            <div class="col-sm-12">                                                                                          
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-question-circle title"></i> T&iacute;tulo do seu An&uacute;ncio *</label>                                                    
	                                                    <input type="text" id="titulo" name="titulo" data-error="Por favor, informe o T&iacute;tulo do seu An&uacute;ncio!" required value="<?php echo $retAd[0]['titulo']; ?>" class="form-control titulo" maxlength="60">
	                                                    <div class="help-block with-errors titulo"></div>
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-12">
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-question-circle descr"></i> Descreva sobre voc&ecirc; e os servi&ccedil;os que realiza *</label>
	                                                    <textarea id="descricao" name="descricao" data-minlength="200" data-error="Por favor, informe a Descri&ccedil;&atilde;o dos servi&ccedil;os que realiza! ATEN&Ccedil;&Atilde;O: N&atilde;o mencione telefones ou endere&ccedil;os de internet no corpo de seu an&uacute;ncio! Utilize os campos apropriados no seu cadastro!" required class="form-control" rows="12"><?php echo $retAd[0]['descricao']; ?></textarea>
	                                                    <div class="help-block with-errors descricao"></div>
	                                                </div>	                                                
	                                            </div>	                                               
                                         </div> 
                                         
                                            
                                         <h4><i class="fa fa-question-circle locs"></i> Locais de Atendimento</h4> 
                                         <div class="row">
                                         <div class="col-sm-4">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-globe"></i> Selecione o Pa&iacute;s que Atende *</label>
                                                    <select id="country" name="country" data-error="Por favor, selecione o Pa&iacute;s de atendimento!" required class="form-control">
														    <option value="all">Todos</option>
													        <option value="za">&Aacute;frica do Sul</option>
													        <option value="de">Alemanha</option>
													        <option value="ar">Argentina</option>
													        <option value="au">Austr&aacute;lia</option>
													        <option value="br" selected>Brasil</option>
													        <option value="ca">Canad&aacute;</option>
													        <option value="es">Espanha</option>
													        <option value="fr">Fran&ccedil;a</option>													        
													        <option value="uk">Inglaterra</option>
													        <option value="it">It&aacute;lia</option>
													        <option value="mx">M&eacute;xico</option>
													        <option value="nz">Nova Zelandia</option>
													        <option value="pt">Portugal</option>
													        <option value="us">U.S.A.</option>													        
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>  
                                           <div class="col-sm-8">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-building"></i> Selecione a cidade de Atendimento *</label>
                                                    <input type="text" id="autocomplete" name="autocomplete" class="form-control" placeholder="Por favor, selecione a cidade de atendimento!">													
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            	<div class="form-group">
                                            		<label><i class="fa fa-map-marker"></i> Mapa dos Hoteis *</label>
                                            		<div id="mymap"></div>
                                            	</div>
                                            </div>
                                            <hr/>
                                            <div class="col-sm-12">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-map-marker"></i> Selecione os Locais onde geralmente costuma atender *</label>
                                                    <select id="localidades" name="localidades[]" data-error="Por favor, selecione ao menos uma localidade!" required class="form-control localidade" multiple="multiple">
                                                    	<?php echo $functions->fCreateComboLocations($retAd[0]['apid']); ?>														  
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>                                              
                                            <div class="col-sm-12">                                                                                          
                                                <div class="form-group">	                                                	 
                                                    <input type="checkbox" name="localproprio" id="localproprio" value="1" <?php echo ($retAd[0]['localproprio'] == 1 ? 'checked' : ''); ?>> <strong>Marque esta op&ccedil;&atilde;o se voc&ecirc; atende tamb&eacute;m em Local Pr&oacute;prio!</strong>
                                                </div> 
                                            </div>
	                                  	
											    <div style="display: none">
											      <div id="info-content">
											        <table>
											          <tr id="iw-url-row" class="iw_table_row">
											            <td id="iw-icon" class="iw_table_icon"></td>
											            <td id="iw-url"></td>
											          </tr>
											          <tr id="iw-address-row" class="iw_table_row">
											            <td class="iw_attribute_name">Endere&ccedil;o:</td>
											            <td id="iw-address"></td>
											          </tr>
											          <tr id="iw-phone-row" class="iw_table_row">
											            <td class="iw_attribute_name">Telefone:</td>
											            <td id="iw-phone"></td>
											          </tr>
											          <tr id="iw-rating-row" class="iw_table_row">
											            <td class="iw_attribute_name">Classifica&ccedil;&atilde;o:</td>
											            <td id="iw-rating"></td>
											          </tr>
											          <tr id="iw-website-row" class="iw_table_row">
											            <td class="iw_attribute_name">Website:</td>
											            <td id="iw-website"></td>
											          </tr>
											        </table>
											      </div>
											    </div>
                                                              
                                         </div>
                                         
                                         <hr />                                                                               
                                         <div class="row">
                                         		<div class="col-sm-6">                                                                                          
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-group"></i> Pessoas que Atendo *</label>
	                                                    
	                                                    <?php $pessoasAtendimento = explode(", ", $retAd[0]['pessoasatendimento']); ?>
	                                                    
														<select id="pessoasatendimento" name="pessoasatendimento[]" data-error="Por favor, selecione ao menos um tipo de atendimento!" required class="multiple-select form-control" multiple="multiple">
														  <option value="Homens" <?php echo (in_array('Homens', $pessoasAtendimento) ? 'selected' : ''); ?>>Homens</option>													   
														  <option value="Mulheres" <?php echo (in_array('Mulheres', $pessoasAtendimento) ? 'selected' : ''); ?>>Mulheres</option>
														  <option value="Casais" <?php echo (in_array('Casais', $pessoasAtendimento) ? 'selected' : ''); ?>>Casais</option>													  
														</select>
														<div class="help-block with-errors"></div>
	                                             	</div> 
	                                             </div>
	                                             <div class="col-sm-6">                                                                                          
		                                                <div class="form-group">
		                                                    <label><i class="fa fa-language"></i> Idiomas que Falo</label>
		                                                    
		                                                    <?php $idiomas = explode(", ", $retAd[0]['idiomas']); ?>
		                                                    
															<select id="idiomas" name="idiomas[]" data-error="Por favor, selecione ao menos um idioma!" required class="multiple-select form-control" multiple="multiple">
															  <option value="Portugu&ecirc;s" <?php echo (in_array(utf8_encode('Português'), $idiomas) ? 'selected' : ''); ?>>Portugu&ecirc;s</option>													   
															  <option value="Ingl&ecirc;s" <?php echo (in_array(utf8_encode('Inglês'), $idiomas) ? 'selected' : ''); ?>>Ingl&ecirc;s</option>
															  <option value="Espanhol" <?php echo (in_array('Espanhol', $idiomas) ? 'selected' : ''); ?>>Espanhol</option>													  
															  <option value="Italiano" <?php echo (in_array('Italiano', $idiomas) ? 'selected' : ''); ?>>Italiano</option>
															  <option value="Japon&ecirc;s" <?php echo (in_array(utf8_encode('Japonês'), $idiomas) ? 'selected' : ''); ?>>Japon&ecirc;s</option>
															  <option value="Russo" <?php echo (in_array('Russo', $idiomas) ? 'selected' : ''); ?>>Russo</option>
															</select>
															<div class="help-block with-errors"></div>
		                                             </div>
	                                     		</div>	                                              
                                         </div>                                         
                                         <hr />   
                                         <h4><i class="fa fa-question-circle mods"></i> Modalidades</h4> 
                                         <div class="row">  
                                           <div class="col-sm-12">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-venus-mars"></i> Selecione as Modalidades desejadas *</label>
                                                    <select id="modalidades" name="modalidades[]" data-error="Por favor, selecione ao menos uma modalidade!" required class="form-control modalidade" multiple="multiple">
														<?php echo $functions->fCreateComboModalities($functions->fPersonModalities($retAd[0]['apid'])); ?>  
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>                                            
                                         </div> 
                                         <hr />   
                                         <h4><i class="fa fa-question-circle cach"></i> Valor do Cach&ecirc;</h4>
                                         <div class="caches">  
                                         	<div class="row"> 	                                         	
                                         	
                                         		<?php $retCache = $functions->fPersonCache($retAd[0]['apid']); ?>
                                         	
	                                            <div class="col-sm-1">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-dollar"></i> 30 min</label>
	                                                    <input type="text" id="c30" name="c30" maxlength="6" value="<?php echo $retCache[0]['c30']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-1">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-dollar"></i> 1 Hr</label>
	                                                    <input type="text" id="c1" name="c1" maxlength="6" value="<?php echo $retCache[0]['c1']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-1">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-dollar"></i> 2 Hr</label>
	                                                    <input type="text" id="c2" name="c2" maxlength="6" value="<?php echo $retCache[0]['c2']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-1">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-dollar"></i> 4 Hr</label>
	                                                    <input type="text" id="c4" name="c4" maxlength="6" value="<?php echo $retCache[0]['c4']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-1">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-dollar"></i> 8 Hr</label>
	                                                    <input type="text" id="c8" name="c8" maxlength="6" value="<?php echo $retCache[0]['c8']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-moon-o"></i> Pernoite (12 Hr)</label>
	                                                    <input type="text" id="c12" name="c12" maxlength="6" value="<?php echo $retCache[0]['c12']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-plane"></i> Viagens (cach&ecirc; di&aacute;rio)</label>
	                                                    <input type="text" id="viagem" name="viagem" maxlength="6" value="<?php echo $retCache[0]['viagem']; ?>" class="form-control money">	                                                    
	                                                </div>
	                                            </div>	                                            	                                            
	                                            <div class="col-sm-3"> 
		                                            <div class="form-group">
	                                                    <label><i class="fa fa-money"></i> Valores dos meus servi&ccedil;os s&atilde;o em</label>	                                                    
	                                                    <select id="moeda" name="moeda" class="form-control">                                                    	
	                                                    	<option value="R$" <?php echo ($retAd[0]['moeda'] == 'R$' ? 'selected' : ''); ?> selected>R$ REAL</option>
	                                                    	<option value="US$" <?php echo ($retAd[0]['moeda'] == 'US$' ? 'selected' : ''); ?>>US$ D&Oacute;LAR</option>
	                                                    	<option value="&euro;$" <?php echo ($retAd[0]['moeda'] == '&euro;$' ? 'selected' : ''); ?>>&euro;$ EURO</option>                                                    	
	                                                    </select>
	                                                </div>  
	                                            </div>
	                                            <div class="col-sm-12">                                              
	                                                <div class="form-group">	                                                    
	                                                    <div class="help-block with-errors money"></div>
	                                                </div>
	                                            </div>
                                           </div>
                                         </div>
                                         <?php if (!empty($retAd[0]['apid'])){ ?>
	                                          <div class="row"> 
	                                           <div class="col-sm-12">                                                                                          
	                                                <div class="form-group">
	                                                	<input type="hidden" name="apid" id="apid" value="<?php echo $retAd[0]['apid']; ?>"> 
	                                                    <input type="checkbox" name="ativo" id="ativo" class="active-ad" value="1" <?php echo ($retAd[0]['ativo'] == 1 ? 'checked' : ''); ?>> <strong>MANTER MEU AN&Uacute;NCIO ATIVO!</strong>
	                                                </div> 
	                                            </div>
	                                         </div>	                                         
                                         <?php } ?> 
                                         <hr/> 
                                         <div class="row"> 
                                           <div class="col-sm-12">                                                                                          
                                                <div class="form-group">
                                                    <h6><i class="fa fa-camera"></i> <i class="fa fa-video-camera"></i> <strong>Clique em avan&ccedil;ar para personalizar seu an&uacute;ncio e adicionar fotos e v&iacute;deos!</strong></h6>
                                                </div> 
                                            </div>
                                         </div> 
                                                                                    
                                         <div class="row">                                           	
                                            <div class="col-sm-12 direita">  
                                            	<a href="<?php echo SIS_URL; ?>dashboard" class="btn btn-warning m-top-30">Cancelar <i class="fa fa-remove"></i></a>                                              
                                                <button type="submit" class="btn btn-primary m-top-30 next">Avan&ccedil;ar <i class="fa fa-chevron-circle-right"></i></button>                                                
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