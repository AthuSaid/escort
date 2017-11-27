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
                                    		
                                    		<strong><h6><i class="fa fa-warning"></i> 1 - Aceita��o dos nossos Termos</strong></h6>

												<p>'.SIS_TITULO.' ("'.SIS_TITULO.' ou Site"), site de an�ncios virtual de conte�do adulto, dispon�vel sob a URL '.SIS_URL.', uma companhia registrada em S�o Paulo/SP Brasil, sob n�mero de registro 140181. Os Servi�os est�o sujeitos aos Termos de Uso ("Termos"), que poder�o ser atualizados pelo '.SIS_TITULO.' sempre que necess�rio. O '.SIS_TITULO.' poder� informar aos seus usu�rios sobre mudan�as significativas nos seus Termos de Uso, colocando-as dispon�veis no Site, por�m cabe ao Usu�rio se interar das atualiza��es dos Termos periodicamente. Ao utilizar '.SIS_URL.' , voc� concorda em ficar vinculado por estes Termos de Uso. Voc� tamb�m concorda com nossa Pol�tica de Privacidade, que � parte integrante destes Termos, e aceita os registros de cookies e sess�es deste site. Se voc� tiver alguma d�vida, obje��o a qualquer termo ou condi��o, diretriz, ou subsequentes altera��es introduzidas no site '.SIS_URL.', recomendamos que n�o o utilize, abandonando-o imediatamente.</p> 
											
											<strong><h6><i class="fa fa-warning"></i> 2 - Conte�do</strong></h6>
											
												<p>O Usu�rio concorda e declara que todos os an�ncios, mensagens, coment�rios, arquivos, imagens, fotos, v�deos, arquivos de som ou outros materiais (aqui definidos como "Conte�do") publicados, transmitidos ou com links no Site, s�o de responsabilidade total do Usu�rio que inseriu o Conte�do. Mais especificamente, o Usu�rio � inteiramente respons�vel por todo e qualquer Conte�do que ele inserir no, ou atrav�s do, Site e/ou dos Servi�os. O Usu�rio entende que o '.SIS_TITULO.' n�o controla e/ou monitora previamente qualquer An�ncio disponibilizado atrav�s do Site pelo Usu�rio anunciante e, portanto, n�o � respons�vel por seu conte�do. Ao acessar e/ou usar o Site, o Usu�rio pode ser exposto a Conte�do eventualmente ofensivo, indecente, incorreto, falso, infrator e/ou repreens�vel. Ademais, o Site e seu Conte�do podem conter links para outros sites da Internet, que n�o s�o relacionados ao '.SIS_TITULO.'. O '.SIS_TITULO.' n�o representa ou garante a autenticidade e exatid�o das informa��es contidas em seu Site, uma vez que o conte�do � inclu�do pelo Usu�rio sem qualquer tipo de inger�ncia do '.SIS_TITULO.'. O acesso feito atrav�s de links a qualquer outro site tamb�m � de responsabilidade e risco do pr�prio Usu�rio. 
                                   		
                                   			<strong>'.('Sob nenhuma circunst�ncia o '.SIS_TITULO.' ser� responsabilizado de forma alguma por Conte�do ou por qualquer perda ou dano de qualquer tipo incorridos como resultado do uso de qualquer conte�do listado, por e-mail ou outra forma disponibilizado atrav�s do Servi�o. O Usu�rio reconhece que o '.SIS_TITULO.', monitora previamente, aprova ou desaprova o seu Conte�do, principalmente &agrave;queles que n&atilde;o est&atilde;o de acordo com estes Termos de Uso. O '.SIS_TITULO.' tem o direito de remover TOTAL ou PARCIALMENTE qualquer Conte�do dispon�vel no Site, a seu pr�prio crit�rio, por violar o nossos valores, estes Termos, a legisla��o e/ou regulamenta��o aplic�vel, ou por qualquer outro motivo que julgar apropriado, sem que isso gere qualquer tipo de direito ao Usu�rio.').'</strong></p> 
											
                                    		<h6><strong><i class="fa fa-warning"></i> 3 - Garantias</strong></h6>
											
												<p>O Usu�rio aceita e est� ciente de de que o '.SIS_TITULO.' n�o controla, revisa ou monitora previamente qualquer dos Conte�dos inseridos por terceiros no Site e, portanto, n�o se responsabiliza pela precis�o, legalidade, veracidade, seguran�a, licitude e/ou qualidade destes. O uso do Site em eventuais transa��es realizadas entre Usu�rios � de sua total responsabilidade e feita por conta e risco do Usu�rio. O '.SIS_TITULO.' tamb�m n�o se responsabiliza por links publicados em nosso Site, tampouco por v�rus ou componentes perigosos que se encontrem conectados ao '.SIS_TITULO.' ou aos Servi�os.</p>		
                                    				
											<h6><strong><i class="fa fa-warning"></i> 4 - Limites do Servi�o</strong></h6>
											
												<p>O Usu�rio aceita e reconhece que o '.SIS_TITULO.' estabelece limites aos seus Servi�os como, por exemplo, n�mero m�ximo de dias que um Conte�do permanecer� no Site, n�mero e tamanho m�ximo de an�ncios publicados no Site, n�mero de mensagens enviadas, ou qualquer Conte�do que seja transmitido pelo '.SIS_TITULO.' ou arquivado no Site e a frequ�ncia que o Usu�rio poder� acessar o Servi�o. Aceita tamb�m que o '.SIS_TITULO.' n�o tem responsabilidade alguma sobre erros ou perda de Conte�do guardado no Site ou transmitido pelo nosso Servi�o. Ademais, reconhece que o '.SIS_TITULO.' se reserva o direito de modificar, suspender ou descontinuar o Servi�o a qualquer momento sem aviso pr�vio, sem que isso gere qualquer tipo de direitos aos Usu�rios ou obriga��es ao '.SIS_TITULO.'.</p>

                                    		<strong><h6><i class="fa fa-warning"></i> 5 - Notifica��o sobre Infra��es</strong></h6>
											
												<p>Caso qualquer pessoa, seja ou n�o Usu�rio do Site, se sentir lesado em rela��o a qualquer An�ncio e/ou Conte�do, poder� encaminhar ao '.SIS_TITULO.' notifica��o por escrito solicitando sua exclus�o e retirada do Site.
												No entanto, para n�o prejudicar Usu�rios de boa-f�, a retirada do An�ncio e/ou Conte�do do Site depender� de efetiva comprova��o ou forte evid�ncia da ilegalidade ou infra��o � lei, direitos de terceiros e/ou a estes Termos.
												As notifica��es dever�o ser encaminhadas ao '.SIS_TITULO.' pela pessoa supostamente lesada ou, se for o caso, pelo titular do direito intelectual violado, contendo as seguintes informa��es:<br><br>
												5.1) Identifica��o do objeto protegido por direitos intelectuais que tenha sido violado, se for o caso;<br>
												5.2) Identifica��o do material que supostamente representa a infra��o, c�digo do(s) An�ncio(s) e/ou link completo do An�ncio, ou, em caso de n�o se tratarem de An�ncios, informa��es necess�rias para a devida identifica��o do Conte�do;<br>
												5.3) Declara��o de que o notificante possui elementos suficientes para embasar a alega��o de viola��o legal; e<br>
												5.4) Declara��o de que as informa��es contidas na notifica��o s�o precisas e verdadeiras, sob pena de incorrer nas consequentes responsabilidades c�veis e penais, e de que o notificante est� autorizado a agir em nome do titular do direito supostamente violado.<br><br>
												As notifica��es dever�o ser encaminhadas ao e-mail '.SIS_EMAIL.'. O notificante reconhece que caso n�o cumpra com todos os requisitos mencionados acima, sua notifica��o poder� n�o ser considerada, sem que isso gere qualquer direito e/ou ateste conhecimento pr�vio do caso pelo '.SIS_TITULO.'.</p>		
                                    				
											<strong><h6><i class="fa fa-warning"></i> 6 - Negocia��es entre Usu�rios</strong></h6>
											
												<p>O Usu�rio est� ciente e aceita que as negocia��es entre organiza��es e/ou indiv�duos que se originem atrav�s deste Servi�o, incluindo pagamento e entrega de bens e servi�os e qualquer outros termos, condi��es, garantias, representa��es, sociedades, etc. associados a tais negocia��es, s�o de responsabilidade total e exclusiva dos Usu�rios comprador e/ou anunciante. O '.SIS_TITULO.' n�o ser� respons�vel por qualquer perda ou dano que resulte de tais negocia��es. O '.SIS_TITULO.' atua apenas como um provedor de conte�do de terceiros, disponibilizando espa�os para An�ncios e Conte�dos de terceiros. Os Usu�rios devem negociar entre si diretamente, sem a interven��o e/ou intermedia��o direta ou indiretamente do '.SIS_TITULO.' e, por isso, o Site permite a divulga��o de contatos pr�prios e independentes dos Usu�rios para que eles possam se contatar fora da plataforma virtual do '.SIS_TITULO.'.</p>
                                    				
                                    		<a id="priv"></a><strong><h6><i class="fa fa-warning"></i> 7 - Pol&iacute;tica de Privacidade e Divulga��o de Informa��o</strong></h6>
											
												<p>Ao usar o Site ou qualquer dos Servi�os, o Usu�rio reconhece e concorda que o '.SIS_TITULO.' poder�, a seu crit�rio, divulgar o Conte�do publicado pelos Usu�rios, assim como reter, armazenar e/ou divulgar as suas informa��es pessoais, endere�o de e-mail, endere�o de IP e outras informa��es no caso de exig�ncia legal, interven��o judicial ou se necess�rio para:<br><br>
	                                    		7.1) colaborar com a��es legais, investiga��es e/ou procedimentos administrativos;<br>
	                                    		7.2) cumprir com esses Termos;<br>
	                                    		7.3) responder a reclama��es referentes � exist�ncia de Conte�do que possa infringir direitos de terceiros ou de car�ter supostamente ilegal;<br>
	                               				7.4) responder a reclama��es de que as informa��es pessoais ou de contato (por exemplo, telefone, endere�o, etc.) de terceiros foram publicadas ou transmitidas sem o consentimento de seu detentor ou como uma forma de ass�dio, chantagem, coa��o, dentre outras;<br> 
	                               				7.5) proteger os direitos, propriedade ou seguran�a pessoal do '.SIS_TITULO.', de seus Usu�rios e do p�blico em geral.</p>		
											
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
