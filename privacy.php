<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();             		    			
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo SIS_TITULO; ?> - Termos de Uso</title>
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

            <section id="hello" class="about-banner bg-mega">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="about_text">
                                <h1 class="text-white text-uppercase shadow-text">Termos de Uso</h1>
                                <ol class="breadcrumb shadow-text">
                                    <li><a href="<?php echo SIS_URL; ?>"><?php echo SIS_TITULO; ?></a></li>
                                    <li class="active"><a href="<?php echo SIS_URL; ?>privacy">termos de uso</a></li>
                                </ol>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->


            <!--About Sections-->
            <section id="feature" class="ab_feature roomy-100">
                <div class="container">
                    <div class="row">
                        <div class="main_ab_feature">

                            <div class="col-md-12">
                                <!-- Head Title -->
                                <div class="head_title">
                                    <h3>Termos de Uso</h3>
                                    <h5><em>Aten&ccedil;&atilde;o. Leia atentamente nossos Termos de Uso e Pol&iacute;tica de Privacidade <?php echo SIS_TITULO;?>!</em></h5>
                                    <div class="separator_left"></div>
                                </div><!-- End off Head Title -->

                                <div class="ab_feature_content wow fadeIn m-top-40">
                                    
                                   <?php echo utf8_encode('
                                    		
                                    		<strong><h6><i class="fa fa-warning"></i> 1 - Aceitação dos nossos Termos</strong></h6>

												<p>'.SIS_TITULO.' ("'.SIS_TITULO.' ou Site"), site de anúncios virtual de conteúdo adulto, disponível sob a URL '.SIS_URL.', uma companhia registrada em São Paulo/SP Brasil, sob número de registro 140181. Os Serviços estão sujeitos aos Termos de Uso ("Termos"), que poderão ser atualizados pelo '.SIS_TITULO.' sempre que necessário. O '.SIS_TITULO.' poderá informar aos seus usuários sobre mudanças significativas nos seus Termos de Uso, colocando-as disponíveis no Site, porém cabe ao Usuário se interar das atualizações dos Termos periodicamente. Ao utilizar '.SIS_URL.' , você concorda em ficar vinculado por estes Termos de Uso. Você também concorda com nossa Política de Privacidade, que é parte integrante destes Termos, e aceita os registros de cookies e sessões deste site. Se você tiver alguma dúvida, objeção a qualquer termo ou condição, diretriz, ou subsequentes alterações introduzidas no site '.SIS_URL.', recomendamos que não o utilize, abandonando-o imediatamente.</p> 
											
											<strong><h6><i class="fa fa-warning"></i> 2 - Conteúdo</strong></h6>
											
												<p>O Usuário concorda e declara que todos os anúncios, mensagens, comentários, arquivos, imagens, fotos, vídeos, arquivos de som ou outros materiais (aqui definidos como "Conteúdo") publicados, transmitidos ou com links no Site, são de responsabilidade total do Usuário que inseriu o Conteúdo. Mais especificamente, o Usuário é inteiramente responsável por todo e qualquer Conteúdo que ele inserir no, ou através do, Site e/ou dos Serviços. O Usuário entende que o '.SIS_TITULO.' não controla e/ou monitora previamente qualquer Anúncio disponibilizado através do Site pelo Usuário anunciante e, portanto, não é responsável por seu conteúdo. Ao acessar e/ou usar o Site, o Usuário pode ser exposto a Conteúdo eventualmente ofensivo, indecente, incorreto, falso, infrator e/ou repreensível. Ademais, o Site e seu Conteúdo podem conter links para outros sites da Internet, que não são relacionados ao '.SIS_TITULO.'. O '.SIS_TITULO.' não representa ou garante a autenticidade e exatidão das informações contidas em seu Site, uma vez que o conteúdo é incluído pelo Usuário sem qualquer tipo de ingerência do '.SIS_TITULO.'. O acesso feito através de links a qualquer outro site também é de responsabilidade e risco do próprio Usuário. 
                                   		
                                   			<strong>'.('Sob nenhuma circunstância o '.SIS_TITULO.' será responsabilizado de forma alguma por Conteúdo ou por qualquer perda ou dano de qualquer tipo incorridos como resultado do uso de qualquer conteúdo listado, por e-mail ou outra forma disponibilizado através do Serviço. O Usuário reconhece que o '.SIS_TITULO.', monitora previamente, aprova ou desaprova o seu Conteúdo, principalmente &agrave;queles que n&atilde;o est&atilde;o de acordo com estes Termos de Uso. O '.SIS_TITULO.' tem o direito de remover TOTAL ou PARCIALMENTE qualquer Conteúdo disponível no Site, a seu próprio critério, por violar o nossos valores, estes Termos, a legislação e/ou regulamentação aplicável, ou por qualquer outro motivo que julgar apropriado, sem que isso gere qualquer tipo de direito ao Usuário.').'</strong></p> 
											
                                    		<h6><strong><i class="fa fa-warning"></i> 3 - Garantias</strong></h6>
											
												<p>O Usuário aceita e está ciente de de que o '.SIS_TITULO.' não controla, revisa ou monitora previamente qualquer dos Conteúdos inseridos por terceiros no Site e, portanto, não se responsabiliza pela precisão, legalidade, veracidade, segurança, licitude e/ou qualidade destes. O uso do Site em eventuais transações realizadas entre Usuários é de sua total responsabilidade e feita por conta e risco do Usuário. O '.SIS_TITULO.' também não se responsabiliza por links publicados em nosso Site, tampouco por vírus ou componentes perigosos que se encontrem conectados ao '.SIS_TITULO.' ou aos Serviços.</p>		
                                    				
											<h6><strong><i class="fa fa-warning"></i> 4 - Limites do Serviço</strong></h6>
											
												<p>O Usuário aceita e reconhece que o '.SIS_TITULO.' estabelece limites aos seus Serviços como, por exemplo, número máximo de dias que um Conteúdo permanecerá no Site, número e tamanho máximo de anúncios publicados no Site, número de mensagens enviadas, ou qualquer Conteúdo que seja transmitido pelo '.SIS_TITULO.' ou arquivado no Site e a frequência que o Usuário poderá acessar o Serviço. Aceita também que o '.SIS_TITULO.' não tem responsabilidade alguma sobre erros ou perda de Conteúdo guardado no Site ou transmitido pelo nosso Serviço. Ademais, reconhece que o '.SIS_TITULO.' se reserva o direito de modificar, suspender ou descontinuar o Serviço a qualquer momento sem aviso prévio, sem que isso gere qualquer tipo de direitos aos Usuários ou obrigações ao '.SIS_TITULO.'.</p>

                                    		<strong><h6><i class="fa fa-warning"></i> 5 - Notificação sobre Infrações</strong></h6>
											
												<p>Caso qualquer pessoa, seja ou não Usuário do Site, se sentir lesado em relação a qualquer Anúncio e/ou Conteúdo, poderá encaminhar ao '.SIS_TITULO.' notificação por escrito solicitando sua exclusão e retirada do Site.
												No entanto, para não prejudicar Usuários de boa-fé, a retirada do Anúncio e/ou Conteúdo do Site dependerá de efetiva comprovação ou forte evidência da ilegalidade ou infração à lei, direitos de terceiros e/ou a estes Termos.
												As notificações deverão ser encaminhadas ao '.SIS_TITULO.' pela pessoa supostamente lesada ou, se for o caso, pelo titular do direito intelectual violado, contendo as seguintes informações:<br><br>
												5.1) Identificação do objeto protegido por direitos intelectuais que tenha sido violado, se for o caso;<br>
												5.2) Identificação do material que supostamente representa a infração, código do(s) Anúncio(s) e/ou link completo do Anúncio, ou, em caso de não se tratarem de Anúncios, informações necessárias para a devida identificação do Conteúdo;<br>
												5.3) Declaração de que o notificante possui elementos suficientes para embasar a alegação de violação legal; e<br>
												5.4) Declaração de que as informações contidas na notificação são precisas e verdadeiras, sob pena de incorrer nas consequentes responsabilidades cíveis e penais, e de que o notificante está autorizado a agir em nome do titular do direito supostamente violado.<br><br>
												As notificações deverão ser encaminhadas ao e-mail '.SIS_EMAIL.'. O notificante reconhece que caso não cumpra com todos os requisitos mencionados acima, sua notificação poderá não ser considerada, sem que isso gere qualquer direito e/ou ateste conhecimento prévio do caso pelo '.SIS_TITULO.'.</p>		
                                    				
											<strong><h6><i class="fa fa-warning"></i> 6 - Negociações entre Usuários</strong></h6>
											
												<p>O Usuário está ciente e aceita que as negociações entre organizações e/ou indivíduos que se originem através deste Serviço, incluindo pagamento e entrega de bens e serviços e qualquer outros termos, condições, garantias, representações, sociedades, etc. associados a tais negociações, são de responsabilidade total e exclusiva dos Usuários comprador e/ou anunciante. O '.SIS_TITULO.' não será responsável por qualquer perda ou dano que resulte de tais negociações. O '.SIS_TITULO.' atua apenas como um provedor de conteúdo de terceiros, disponibilizando espaços para Anúncios e Conteúdos de terceiros. Os Usuários devem negociar entre si diretamente, sem a intervenção e/ou intermediação direta ou indiretamente do '.SIS_TITULO.' e, por isso, o Site permite a divulgação de contatos próprios e independentes dos Usuários para que eles possam se contatar fora da plataforma virtual do '.SIS_TITULO.'.</p>
                                    				
                                    		<a id="priv"></a><strong><h6><i class="fa fa-warning"></i> 7 - Pol&iacute;tica de Privacidade e Divulgação de Informação</strong></h6>
											
												<p>Ao usar o Site ou qualquer dos Serviços, o Usuário reconhece e concorda que o '.SIS_TITULO.' poderá, a seu critério, divulgar o Conteúdo publicado pelos Usuários, assim como reter, armazenar e/ou divulgar as suas informações pessoais, endereço de e-mail, endereço de IP e outras informações no caso de exigência legal, intervenção judicial ou se necessário para:<br><br>
	                                    		7.1) colaborar com ações legais, investigações e/ou procedimentos administrativos;<br>
	                                    		7.2) cumprir com esses Termos;<br>
	                                    		7.3) responder a reclamações referentes à existência de Conteúdo que possa infringir direitos de terceiros ou de caráter supostamente ilegal;<br>
	                               				7.4) responder a reclamações de que as informações pessoais ou de contato (por exemplo, telefone, endereço, etc.) de terceiros foram publicadas ou transmitidas sem o consentimento de seu detentor ou como uma forma de assédio, chantagem, coação, dentre outras;<br> 
	                               				7.5) proteger os direitos, propriedade ou segurança pessoal do '.SIS_TITULO.', de seus Usuários e do público em geral.</p>		
											
										');?>

                                </div>
                            </div>
                            
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section>


            <!-- scroll up-->
            <div class="scrollup">
                <a href="#"><i class="fa fa-chevron-up"></i></a>
            </div><!-- End off scroll up -->


            <!-- MENU DE NAVEGACAO - FOOTER -->
            <?php require_once '_requires/footer.php'; ?>


        </div>

        <!-- JS includes -->
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

    </body>
</html>
