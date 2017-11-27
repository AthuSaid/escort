<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
	if (!SIS_MANUTENCAO && SIS_INAUGURACAO == '')
	{		
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
        <title><?php echo SIS_TITULO; ?></title>        
        <meta name="robots" content="noindex,nofollow" />
		<meta name="googlebot" content="noindex,nofollow" />		
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

        <div class="culmn">
                   
            <!--Home Sections-->
            <section id="hello" class="teaser-banner-<?php echo rand(1,1);?> bg-mega">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="about_text">
                                <img src="<?php echo SIS_URL; ?>assets/images/logos/teaser.png">
                                
                                <?php if (SIS_MANUTENCAO){ ?>
                                	<h6 class="text-white shadow-text">O site est&aacute; temporariamente em manuten&ccedil;&atilde;o! Voltaremos em instantes!</h6>
                                <?php }
                                	  if (!SIS_MANUTENCAO && SIS_INAUGURACAO != ''){ ?>                                	  
	                                <h6 class="text-white shadow-text">O maior portal de acompanhantes e massagistas est&aacute; chegando!</h6>
	                                <h1 class="text-white shadow-text time-remaining"></h1>	                                
                                <?php } ?>  
                                                                                         
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->
        </div>

        <!-- JS includes -->
        <?php 
        	$dt1 = date_create(date("Y-m-d H:i:s"));
        	$dt2 = date_create(SIS_INAUGURACAO);
        	$interval = (date_diff($dt1, $dt2));
        ?>
        <script>var $d=<?php echo $interval->d; ?>,$h=<?php echo $interval->h; ?>,$i=<?php echo $interval->i; ?>,$s=<?php echo $interval->s; ?>,$m=<?php echo $interval->m; ?></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/isotope.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.easing.1.3.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/slick.min.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/jquery.collapse.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/bootsnav.js"></script>
        <script src="<?php echo SIS_URL; ?>assets/js/plugins.js"></script>
		<script src="<?php echo SIS_URL; ?>assets/js/tcr.js"></script>
    </body>
</html>
