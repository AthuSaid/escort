<?php
    session_start();
        
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
        <title><?php echo SIS_TITULO; ?> - Contato</title>
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
            <section id="hello" class="dash-banner-<?php echo $functions->genderPrefer.rand(1,5);?> bg-mega">
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="contact_text">
                                <h1 class="text-white text-uppercase shadow-text">Contate-nos</h1>
                                <ol class="breadcrumb shadow-text">
                                    <li><a href="<?php echo SIS_URL; ?>">Home</a></li>
                                    <li class="active"><a href="#">Contate-nos</a></li>
                                </ol>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->


            <!--Call To Action Section-->

            <section id="action" class="action roomy-70">
                <div class="container">
                    <div class="row">
                        <div class="main_action text-center">
                            <!--div class="col-md-4">
                                <div class="action_item">
                                    <i class="fa fa-map-marker"></i>
                                    <h4 class="text-uppercase m-top-20">Address</h4>
                                    <p>7th floor - Palace Building - 221B Walk of Fame - <br /> London - UK</p>
                                </div>
                            </div-->
                            <div class="col-md-4">
                                <div class="action_item">
                                    <i class="fa fa-phone"></i>
                                    <h4 class="text-uppercase m-top-20">contato</h4>
                                    <p>(+55) 11 - 94309-8777</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="action_item">
                                    <i class="fa fa-envelope-o"></i>
                                    <h4 class="text-uppercase m-top-20">email</h4>
                                    <p><?php echo SIS_EMAIL; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!--Contact Us Section-->
            
            <section id="contact" class="contact fix">
                <div class="container">                
                  <hr />   
                  <h4>@ Entre em Contato</h4>
                  <h5><i>Suas informa&ccedil;&otilde;es ser&atilde;o respondidas em no m&aacute;ximo 2 dias!</i></h5>
                    <div class="row">
                        <div class="main_contact p-top-60">
                            <div class="col-md-6 sm-m-top-30">
                                <form method="post" role="form" name="form-contact" id="form-contact" data-toggle="validator">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label>Seu Nome *</label>
                                                <input id="name" name="name" maxlength="50" type="text" data-error="Por favor, informe seu Nome!" required class="form-control" required="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Seu Email *</label>
                                                <input id="email" name="email" maxlength="50" type="text" data-error="Por favor, informe seu Email!" required class="form-control">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Selecione o Assunto *</label>
                                                <select id="subject" name="subject" data-error="Por favor, selecione o Assunto para atendimento!" required class="form-control">
												    <option value="">Selecione</option>
												    <option value="Duvidas">D&uacute;vidas</option>
											        <option value="Elogios">Elogios</option>
											        <option value="Reclamacoes">Reclama&ccedil;&otilde;es</option>
											        <option value="Sugestoes">Sugest&otilde;es</option>
											        <option value="Contratar">Contratar Servi&ccedil;o de Fotografia</option>
												</select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group"> 
                                                <label>Sua Mensagem *</label>
                                                <textarea id="message" name="message" class="form-control" rows="9" data-error="Por favor, digite sua Mensagem!" required ></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">ENVIAR <i class="fa fa-send"></i></button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>

                            <div class="col-md-6">
                                <div class="contact_img">
                                    <img src="assets/images/contact-img.png" alt="" />
                                </div>
                            </div>


                        </div>
                    </div><!--End off row -->
                </div><!--End off container -->
            </section><!--End off Contact Section-->


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
        <script src="<?php echo SIS_URL; ?>assets/js/validator.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/main.js"></script>
		<script src="<?php echo SIS_URL; ?>assets/js/form.js"></script>
    </body>
</html>
