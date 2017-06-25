<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
	
	session_start2();
    
    $functions = new functions();  
     
    if ($_SESSION['sPersonLogged'])
    {    	
    	$retPerson = $functions->fGetPersonRegister($_SESSION['sPersonUrl']);
    		 
    	if (count($retPerson) == 0)
    	{
    		header('Location: '.SIS_URL.'signup');
    		exit;
    	}    		    			
    }
    
    # disable mandatory fields in edit approved person
    $disabled 		= ($retPerson[0]['aprovado'] == 1 ? 'class="form-control form-control-disabled disabled" readonly' : 'class="form-control"');
    # disable input files in edit approved person
    $disabledFile 	= ($retPerson[0]['aprovado'] == 1 ? 'type="text" value="Documento j&aacute; verificado e aprovado!" class="form-control form-control-disabled disabled" disabled' : 'type="file" class="form-control"');
       
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - Novo Cadastro</title>
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
                                <h1 class="text-white text-uppercase text-shadow"><?php echo ($_SESSION['sPersonLogged'] ? "Meu Cadastro" : "Cadastre-se");?></h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li><a href="<?php echo SIS_URL; ?>dashboard">Minha Conta</a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?><?php echo ($_SESSION['sPersonLogged'] ? "profile" : "signup");?>">Meu Cadastro</a></li>
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
                                
                                <form method="post" role="form" name="form-signup" id="form-signup" data-toggle="validator" enctype="multipart/form-data">
                                
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
                                                    <label><i class="fa fa-question-circle nomfic"></i> Nome Fict&iacute;cio *</label>                                                    
                                                    <input type="text" id="apelido" name="apelido" data-error="Por favor, informe um Nome Fict&iacute;cio!" required <?php echo $disabled; ?> value="<?php echo ($retPerson[0]['apelido'] != '' ? $retPerson[0]['apelido'] : $_SESSION['sPersonPreAka']); ?>" placeholder="Seu nome Profissional que ser&aacute; utilizado no site!" maxlength="50">
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
	                                                    <input type="email" id="email" name="email" data-error="Por favor, informe um e-mail v&aacute;lido" required <?php echo $disabled; ?> placeholder="Informe um E-mail v&aacute;lido!" value="<?php echo ($retPerson[0]['email'] != '' ? $retPerson[0]['email'] : $_SESSION['sPersonPreEml']); ?>" maxlength="50">
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
                                          
                                          <?php if (!empty($retPerson[0]['pesid'])){ ?>
	                                          <div class="row"> 
	                                           <div class="col-sm-12">                                                                                          
	                                                <div class="form-group">
	                                                    <input type="checkbox" class="active-person" value="1" <?php echo ($retPerson[0]['ativo'] == 1 ? 'checked' : ''); ?>> <strong>MANTER MEU PERFIL ATIVO E VIS&Iacute;VEL NO SITE!</strong>
	                                                </div> 
	                                            </div>
	                                         </div>  
                                         <?php } ?>  
                                            
                                         <hr />   
                                         <h4>Minhas Especialidades</h4> 
                                         <div class="row">  
                                           <div class="col-sm-12">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-signing"></i> Informe sua Especialidade *</label>
                                                    <select id="especialidade" name="especialidade" data-error="Por favor, informe sua Especialidade." required class="form-control">
													  <option value="" selected>Selecione</option>													  
													  <option value="A" <?php echo ($retPerson[0]['especialidade'] == 'A' ? 'selected' : ''); ?>>Servi&ccedil;os de Acompanhante</option>
													  <option value="M" <?php echo ($retPerson[0]['especialidade'] == 'M' ? 'selected' : ''); ?>>Massagens Terap&ecirc;uticas</option>
													  <option value="T" <?php echo ($retPerson[0]['especialidade'] == 'T' ? 'selected' : ''); ?>>Todas as Especialidades Acima</option>													   
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                         </div>      
                                         
                                         <hr />   
                                         <h4>Suas Caracter&iacute;sticas F&iacute;sicas</h4> 
                                         <div class="row">  
                                           <div class="col-sm-4">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-user-circle"></i> Etnia *</label>
                                                    <select id="etnia" name="etnia" data-error="Por favor, informe sua Etnia." required class="form-control etnia">
													  <option value="" selected>Selecione</option>													  
													  <option value="Branca" <?php echo ($retPerson[0]['etnia'] == 'Branca' ? 'selected' : ''); ?>>Branca</option>
													  <option value="Cabocla" <?php echo ($retPerson[0]['etnia'] == 'Cabocla' ? 'selected' : ''); ?>>Cabocla</option>
													  <option value="Cafuza" <?php echo ($retPerson[0]['etnia'] == 'Cafuza' ? 'selected' : ''); ?>>Cafuza</option>													   
													  <option value="Indigena" <?php echo ($retPerson[0]['etnia'] == 'Indigena' ? 'selected' : ''); ?>>Indigena</option>
													  <option value="Mulata" <?php echo ($retPerson[0]['etnia'] == 'Mulata' ? 'selected' : ''); ?>>Mulata</option>
													  <option value="Negra" <?php echo ($retPerson[0]['etnia'] == 'Negra' ? 'selected' : ''); ?>>Negra</option>
													  <option value="Oriental" <?php echo ($retPerson[0]['etnia'] == 'Oriental' ? 'selected' : ''); ?>>Oriental</option>													  
													  <option value="Parda" <?php echo ($retPerson[0]['etnia'] == 'Parda' ? 'selected' : ''); ?>>Parda</option>
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>                                            
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
                                                    <label><i class="fa fa-transgender-alt"></i> Orienta&ccedil;&atilde;o Sexual *</label>
                                                    <select id="genero" name="genero" data-error="Por favor, informe sua Orienta&ccedil;&atilde;o Sexual." required class="form-control genero">
                                                    <?php if ($retPerson[0]['sexo'] == 'M'){ ?>                                                    	
														<option value="mars" <?php echo ($retPerson[0]['genero'] == 'mars' ? 'selected' : ''); ?>>H&eacute;terossexual</option>
														<option value="dbm" <?php echo ($retPerson[0]['genero'] == 'dbm' ? 'selected' : ''); ?>>Homossexual</option>
														<option value="mercury" <?php echo ($retPerson[0]['genero'] == 'mercury' ? 'selected' : ''); ?>>Bissexual</option>
                                                    <?php }elseif ($retPerson[0]['sexo'] == 'F') { ?>
                                                    	<option value="venus" <?php echo ($retPerson[0]['genero'] == 'venus' ? 'selected' : ''); ?>>H&eacute;terossexual</option>
														<option value="dbv" <?php echo ($retPerson[0]['genero'] == 'dbv' ? 'selected' : ''); ?>>Homossexual</option>
														<option value="mercury" <?php echo ($retPerson[0]['genero'] == 'mercury' ? 'selected' : ''); ?>>Bissexual</option>
                                                    <?php }elseif ($retPerson[0]['sexo'] == 'T') { ?>
	                                                    <option value="dbv" <?php echo ($retPerson[0]['genero'] == 'dbv' ? 'selected' : ''); ?>>Homossexual</option>
														<option value="mercury" <?php echo ($retPerson[0]['genero'] == 'mercury' ? 'selected' : ''); ?>>Bissexual</option>
                                                    <?php } ?>													  
													</select>
													<div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                          </div>  
                                         <div class="row"> 
	                                         <div class="col-sm-2">                                              
	                                                <div class="form-group">
	                                                    <label>Cor dos Olhos *</label>
	                                                    <select id="olhos" name="olhos" data-error="Por favor, informe a cor dos seus Olhos." required class="form-control olhos">
														  <option value="" selected>Selecione</option>
														  <option value="Azuis" <?php echo ($retPerson[0]['olhos'] == 'Azuis' ? 'selected' : ''); ?>>Azuis</option>													   
														  <option value="Castanhos" <?php echo ($retPerson[0]['olhos'] == 'Castanhos' ? 'selected' : ''); ?>>Castanhos</option>
														  <option value="Verdes" <?php echo ($retPerson[0]['olhos'] == 'Verdes' ? 'selected' : ''); ?>>Verdes</option>
														  <option value="Cor de Mel" <?php echo ($retPerson[0]['olhos'] == 'Cor de Mel' ? 'selected' : ''); ?>>Cor de Mel</option>
														  <option value="Pretos" <?php echo ($retPerson[0]['olhos'] == 'Pretos' ? 'selected' : ''); ?>>Pretos</option>
														</select>
														<div class="help-block with-errors"></div>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2">                                              
	                                                <div class="form-group">
	                                                    <label>Cor dos Cabelos *</label>
	                                                    <select id="cabelos" name="cabelos" data-error="Por favor, informe a cor dos seus Olhos." required class="form-control cabelos">
														  <option value="" selected>Selecione</option>
														  <option value="Azuis" <?php echo ($retPerson[0]['cabelos'] == 'Azuis' ? 'selected' : ''); ?>>Azuis</option>
														  <option value="Brancos" <?php echo ($retPerson[0]['cabelos'] == 'Brancos' ? 'selected' : ''); ?>>Brancos</option>													   
														  <option value="Castanhos" <?php echo ($retPerson[0]['cabelos'] == 'Castanhos' ? 'selected' : ''); ?>>Castanhos</option>
														  <option value="Cinza" <?php echo ($retPerson[0]['cabelos'] == 'Cinza' ? 'selected' : ''); ?>>Cinza</option>
														  <option value="Loiros" <?php echo ($retPerson[0]['cabelos'] == 'Loiros' ? 'selected' : ''); ?>>Loiros</option>
														  <option value="Ruivos" <?php echo ($retPerson[0]['cabelos'] == 'Ruivos' ? 'selected' : ''); ?>>Ruivos</option>
														  <option value="Vermelhos" <?php echo ($retPerson[0]['cabelos'] == 'Vermelhos' ? 'selected' : ''); ?>>Vermelhos</option>
														</select>
														<div class="help-block with-errors"></div>
	                                                </div>
	                                            </div>                                        
	                                            <div class="col-sm-2">                                                                                          
	                                                <div class="form-group">
	                                                    <label>Peso (kg)</label>                                                    
	                                                    <input type="text" id="peso" name="peso" class="form-control num3" value="<?php echo $retPerson[0]['peso']; ?>">
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-2">                                                                                          
	                                                <div class="form-group">
	                                                    <label>Altura (cm)</label>                                                    
	                                                    <input type="text" id="altura" name="altura" class="form-control altura" value="<?php echo $retPerson[0]['altura']; ?>">
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-1">                                                                                          
	                                                <div class="form-group">
	                                                    <label>Busto </label>                                                    
	                                                    <input type="text" id="busto" name="busto" class="form-control num3" value="<?php echo $retPerson[0]['busto']; ?>">
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-1">                                                                                          
	                                                <div class="form-group">
	                                                    <label>Cintura </label>                                                    
	                                                    <input type="text" id="cintura" name="cintura" class="form-control num3" value="<?php echo $retPerson[0]['cintura']; ?>">
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-1">                                                                                          
	                                                <div class="form-group">
	                                                    <label>Quadril </label>                                                    
	                                                    <input type="text" id="quadril" name="quadril" class="form-control num3" value="<?php echo $retPerson[0]['quadril']; ?>">
	                                                </div> 
	                                            </div> 
	                                            <div class="col-sm-1">                                                                                          
	                                                <div class="form-group">
	                                                    <label>Dote </label>                                                    
	                                                    <input type="text" <?php echo ($retPerson[0]['sexo'] == 'F' ? 'disabled="disabled"' : ''); ?> id="pcm" name="pcm" class="form-control pcm" value="<?php echo $retPerson[0]['pcm']; ?>">
	                                                </div> 
	                                            </div>
	             								  
                                           </div>
                                          
                                         <hr />
                                         <h4>Contato & Redes Sociais</h4>  
                                         
                                         <div class="row">
	                                            <div class="col-sm-4">                                                                                          
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-whatsapp"></i> WhatsApp</label>                                                    
	                                                    <input type="text" name="whatsapp" id="whatsapp" class="form-control tel" value="<?php echo $retPerson[0]['whatsapp']; ?>">
	                                                    <div class="help-block with-errors tel"></div>
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-4">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-phone"></i> Telefone Contato 1</label>
	                                                    <input name="tel1" id="tel1" type="text" class="form-control required tel" value="<?php echo $retPerson[0]['tel1']; ?>">
	                                                    <div class="help-block with-errors tel"></div>	                                                	
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-4">                                                 
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-phone"></i> Telefone Contato 2</label>
	                                                    <input type="text" name="tel2" id="tel2" class="form-control tel" value="<?php echo $retPerson[0]['tel2']; ?>">
	                                                    <div class="help-block with-errors tel"></div>
	                                                </div>
	                                            </div>
                                            </div>
                                         
                                         	<div class="row">                                         
	                                            <div class="col-sm-4">                                                                                          
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-facebook"></i> Perfil Facebook (Opcional)</label>                                                    
	                                                    <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Exemplo: https://www.facebook.com/<?php echo ($retPerson[0]['url'] != '' ? $retPerson[0]['url'] : $functions->fFormatTitle4Url($_SESSION['sPersonPreAka'])); ?>" value="<?php echo $retPerson[0]['facebook']; ?>">
	                                                </div> 
	                                            </div>
	                                            <div class="col-sm-4">                                              
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-twitter"></i> Perfil Twitter (Opcional)</label>
	                                                    <input type="text" id="twitter" name="twitter" placeholder="Exemplo: https://www.twitter.com/<?php echo ($retPerson[0]['url'] != '' ? $retPerson[0]['url'] : $functions->fFormatTitle4Url($_SESSION['sPersonPreAka'])); ?>" class="form-control required" value="<?php echo $retPerson[0]['twitter']; ?>">
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-4">                                                 
	                                                <div class="form-group">
	                                                    <label><i class="fa fa-instagram"></i> Perfil Instagram (Opcional)</label>
	                                                    <input type="text" id="googleplus" name="googleplus" placeholder="Exemplo: https://www.instagram.com/<?php echo ($retPerson[0]['url'] != '' ? $retPerson[0]['url'] : $functions->fFormatTitle4Url($_SESSION['sPersonPreAka'])); ?>" class="form-control required" value="<?php echo $retPerson[0]['googleplus']; ?>">
	                                                </div>
	                                            </div>    
                                            </div>
                                            
                                                                                        
                                         <hr />  
                                         <h4>Documenta&ccedil;&atilde;o</h4>
                                         <div class="row">                                         
                                            <div class="col-sm-3">                                                                                          
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle docrg"></i> RG *</label>                                                    
                                                    <input type="text" id="rg" name="rg" data-error="Por favor, informe seu RG!" required <?php echo $disabled; ?> value="<?php echo $retPerson[0]['rg']; ?>">
                                                	<div class="help-block with-errors"></div>
                                                </div> 
                                            </div>
                                            <div class="col-sm-3">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle doccpf"></i> CPF *</label>
                                                    <input type="text" name="cpf" id="cpf" data-remote="../_actions/validator.php" data-error="CPF incorreto ou j&aacute; cadastrado!" required <?php echo $disabled; ?> value="<?php echo $retPerson[0]['cpf']; ?>">                                               
	                                                <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">                                                 
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle docanex1"></i> Anexar Documento *</label>
                                                    <input id="documento" name="documento" data-error="&Eacute; obrigat&oacute;rio anexar um documento COM FOTO para comprovar sua identidade! (Ex: RG, CNH, RNE)." required <?php echo $disabledFile; ?>>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                         <div class="row">
                                           <div class="col-sm-3">                                                                                          
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle dtnasc"></i> Data de Nascimento *</label>                                                    
                                                    <input type="text" id="nascimento" name="nascimento" data-error="Por favor, sua data de Nascimento!" required <?php echo $disabled; ?> value="<?php echo $retPerson[0]['nascimento']; ?>">
                                                	<div class="help-block with-errors"></div>	
                                                </div> 
                                            </div>
                                            <div class="col-sm-3">                                                                                          
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle natura"></i> Naturalidade *</label>                                                    
                                                    <input type="text" id="naturalidade" name="naturalidade" data-error="Por favor, sua cidade natal!" required class="form-control" value="<?php echo $retPerson[0]['naturalidade']; ?>" maxlength="50">
                                                	<div class="help-block with-errors"></div>
                                                </div> 
                                            </div>
                                            <div class="col-sm-6">                                              
                                                <div class="form-group">
                                                    <label><i class="fa fa-question-circle docanex2"></i> Comprova&ccedil;&atilde;o de Identidade *</label>
                                                    <input id="comprovacao" name="comprovacao" data-error="&Eacute; obrigat&oacute;rio anexar uma foto sua para comprovar sua identidade!." required <?php echo $disabledFile; ?>>
                                                	<div class="help-block with-errors"></div>
                                                </div>
                                            </div>	
                                            <div class="col-sm-12 direita">                                                
                                                <a href="<?php echo (!isset($_SESSION['sPersonLogged']) ? SIS_URL.'home' : SIS_URL.'dashboard'); ?>" class="btn btn-warning m-top-30">Voltar <i class="fa fa-arrow-left"></i></a>
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
        <script src="<?php echo SIS_URL; ?>assets/js/balloon.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/cities.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6rl2gdPs77uwQqT-QDNVdmzGrbKA5Emo&libraries=places&callback=initMap" async defer></script>
        
        <script type="text/javascript">
				$(".js-example-basic-multiple").select2({
					placeholder: "Select a state"
				});
				$(".genero").select2({
					placeholder: "Selecione"
				});
				var options =  {		  
					  onComplete: function(val){
					    var date = val.split("/");
					    var currYear = <?php echo date("Y"); ?>;
					    if (((currYear - date[2]) < 18) || date[1] > 12 || date[0] > 31 || (date[0] > 29 && date[1] == 2))	
					    	$('.nascimento').val('');
				    		$('.nascimento').attr('placeholder', 'Proibido para menores de 18 anos!');	    
					  }
					};
				$('#nascimento').mask('00/00/0000', options);
				$('.tel').mask('(00) 00000-0000');
				$('.num3').mask('000');
				$('.pcm').mask('00');
				$('.altura').mask('0,00');
				$('#cpf').mask('000.000.000-00');
				
				$('.active-person').on('click', function(){	
					if (!$(this).is(':checked')) {
						if (confirm('Desmarcando esta op\u00e7\u00e3o, seu perfil n\u00e3o aparecer\u00e1 no portal, at\u00e9 que o mesmo seja ativado novamente. Deseja mesmo desativar?')) {
							$(this).attr('checked', false);
						}else{
							$(this).prop('checked', true);
						}
					}		
				});
				
				$('.sexo').on('change', function(){
					$(".genero option[value='mercury']").remove();
					if($(this).val() == 'M'){
						$('.pcm').attr('disabled', false);
						$(".genero option[value='dbv']").remove();
						$(".genero").append('<option value="" selected>Selecione</option>');
						$(".genero").append('<option value="mars">H&eacute;terossexual</option>');
						$(".genero").append('<option value="dbm">Homossexual</option>');
						$(".genero").append('<option value="mercury">Bissexual</option>');
					}else if($(this).val() == 'F'){
						$('.pcm').attr('disabled', true);
						$(".genero option[value='mars']").remove();
						$(".genero option[value='dbm']").remove();
						$(".genero").append('<option value="" selected>Selecione</option>');
						$(".genero").append('<option value="venus">H&eacute;terossexual</option>');
						$(".genero").append('<option value="dbv">Homossexual</option>');
						$(".genero").append('<option value="mercury">Bissexual</option>');						
					}else if($(this).val() == 'T'){
						$('.pcm').attr('disabled', false);
						$(".genero option[value='mars']").remove();
						$(".genero option[value='dbm']").remove();
						$(".genero option[value='dbv']").remove();
						$(".genero option[value='venus']").remove();
						$(".genero").append('<option value="" selected>Selecione</option>');
						$(".genero").append('<option value="dbv">Homossexual</option>');
						$(".genero").append('<option value="mercury">Bissexual</option>');				
					}				
				});
				$( function() {
				   $(document).tooltip();
				});
				
			</script>        
    </body>
</html>