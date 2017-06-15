<div id="divFirstAccess" class="modal-dialog" style="display:none;">
   		<p>Thanks for clicking.  That felt good.  <a href="#" rel="modal:close">Close</a> or press ESC</p>      
	   <div class="col-sm-4">
			<div class="form-group"> 
	        	<label>Eu sou</label>
	            <select class="form-control" id="myGender">
		   			<option value="M" selected>Homem</option>
		   			<option value="F">Mulher</option>
		   			<option value="T">Travesti</option>
		   		</select>
	   		</div>
	   </div>
	   <div class="col-sm-4">
			<div class="form-group"> 
	        	<label>Estou procurando por</label>
	            <select class="form-control" id="findGender">
			   		<option value="M">Homem</option>
			   		<option value="F" selected>Mulher</option>
			   		<option value="A">Ambos</option>
		   		</select>
	   		</div>
	   </div>
	   <div class="col-sm-4">
			<div class="form-group"> 
	        	<label>Servi&ccedil;os</label>
	            <select class="form-control" id="services">
			   		<option value="A">Acompanhantes</option>
			   		<option value="M">Massagens</option>
			   		<option value="T" selected>Todos</option>
		   		</select>
	   		</div>
	   </div>
	   <div class="col-sm-12">		
	        <div class="form-group">
	        	<a href="#" onclick="fSetCookieData();" class="btn btn-primary f">Salvar</a>
	        </div>
	  </div>   
</div>
<div id="divDisclaimerAge" class="modal-dialog" style="display:none;">
   		
				<div class="service_items">
                     <div class="row">
                             <div class="col-sm-2">                             	
                                  <div class="plus18">
                                    <div class="about-content2">
                                    	<span class="fa font-bubble">18</span>
                                	</div>    
                             	  </div>							                           	
                             </div>
                             <div class="col-sm-10">                               
                                <div class="text-left service_left_text">
                                <h4 class="main-color black"><strong>ATEN&Ccedil;&Atilde;O</strong> Conte&uacute;do Adulto!</h4>
                            	<p>Antes de prosseguir sua visita no <?php echo SIS_TITULO?>, voc&ecirc; deve aceitar os seguintes termos:</p>
									<p><strong>a.</strong> Comprovar que possuo mais de 18 anos.</p>									
									<p><strong>b.</strong> Compreender que haver&aacute; nudez expl&iaacute;cita neste site, que &eacute; destinado exclusivamente para adultos.									
									<p><strong>c.</strong> Todo conte&uacute;do n&atilde;o ir&aacute; causar problemas ou inc&ocirc;modos a mim.									
									<p><strong>d.</strong> Confirmando minha idade abaixo, eu concordo que os propriet&aacute;rios e fundadores do <?php echo SIS_TITULO?>, bem como os provedores de Internet, n&atilde;o se encarregam da responsabilidade sobre os conte&uacute;dos publicados e o uso dos mesmos.									
								<p>Para mais informa&ccedil;&atilde;oes, por favor leia nossos <a href="<?php echo SIS_URL?>privacy" target="_blank">Termos de Uso</a>.</p>
                        	</div>
                        	
                    	</div>
                	</div>
                </div>    		
   		<div class="col-sm-12">
   			<div class="form-group">
   				<p>Confirme seu m&ecirc;s e ano de nascimento para prosseguir! Caso deseje sair deste site, <a href="http://www.google.com">clique aqui</a>!</p>
   			</div>	
   		</div>      
	   <div class="col-sm-6">
			<div class="form-group"> 
	        	<label>M&ecirc;s *</label>
	            <select class="form-control" id="month">
	            	<option value="">Selecione</option>
		   			<option value="01">Janeiro</option>
		   			<option value="02">Fevereiro</option>
		   			<option value="03">Mar&ccedil;o</option>
		   			<option value="04">Abril</option>
		   			<option value="05">Maio</option>
		   			<option value="06">Junho</option>
		   			<option value="07">Julho</option>
		   			<option value="08">Agosto</option>
		   			<option value="09">Setembro</option>
		   			<option value="10">Outubro</option>
		   			<option value="11">Novembro</option>
		   			<option value="12">Dezembro</option>
		   		</select>
	   		</div>
	   </div>
	   <div class="col-sm-6">
			<div class="form-group"> 
	        	<label>Ano *</label>
	            <select class="form-control" id="year">
	            	<option value="">Selecione</option>
			   		<?php for ($a = (date("Y")-80); $a <= (date("Y")-18); $a++){ ?>
			   			<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
			   		<?php }?>
		   		</select>
	   		</div>
	   </div>
	   <div class="col-sm-12" align="center">		
	        <div class="form-group">
	        	<a href="#" onclick="fSetCookieAge();" class="btn btn-primary">Verificar</a>
	        	<a href="http://www.google.com" class="btn btn-warning">Cancelar</a>
	        </div>
	  </div>   
</div>

<nav class="navbar navbar-default navbar-fixed white no-background bootsnav text-uppercase">

				<!-- Start Top Search -->
                <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control search-field" placeholder="Pesquise por Acompanhantes, Massagistas ou Modalidades">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <!-- End Top Search -->

                <div class="container">    
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                        
	                        <li class="search">
                                <a href="#">
                                    <i class="fa fa-search"></i>                                                                        
                                </a>
	                         </li>       
                        
                            <?php if (!isset($_SESSION['sPersonLogged'])) { ?>
                            
	                            <li class="dropdown">
	                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
	                                    <i class="fa fa-sign-in"></i>                                                                        
	                                </a>
		                                <ul class="dropdown-menu text-capitalize">
		                                	<form method="post" role="form" name="form-signin" id="form-signin" data-toggle="validator">
			                                    <li>
			                                    	<div class="col-sm-12">
				                                        <div class="form-group">
			                                                <label>E-mail *</label>                                                    
			                                                <input type="text" tabindex="1" id="eml" name="eml" data-error="Informe seu Email e Senha corretamente!" required class="form-control frm-login" placeholder="Informe seu Email!">
			                                             	<div class="help-block with-errors login"></div>
			                                             </div>
		                                             </div>
			                                    </li> 
			                                    <li>
			                                        <div class="col-sm-12">                                             		                                                                                       
		                                                <div class="form-group">
		                                                    <label>Senha *</label>                                                    
		                                                    <input type="password" tabindex="2" id="pwd" name="pwd" class="form-control frm-login" placeholder="Informe sua Senha!">		                                                	
		                                                </div> 
		                                            </div> 
			                                    </li> 
			                                    <li>
			                                    	<div class="col-sm-12">                                             		                                                                                       
		                                                <div class="form-group">
			                                        		<button type="submit" class="btn btn-primary signup">Entrar <i class="fa fa-sign-in"></i></button>
			                                        	</div>
			                                        </div>
			                                    </li>                                    
		                            		</form>
		                                </ul>
	                            </li>  
	                                                      
                            <?php } else { ?>
                                                        	
	                            <li class="dropdown">
	                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
	                                    <i class="fa fa-comment"></i>
	                                    <span class="badge counter-notify"></span>
	                                </a>
	                                <ul class="dropdown-menu cart-list text-capitalize notify-html"></ul>
	                            </li>
	                            <li class="dropdown">
                            		<a href="<?php echo SIS_URL;?>signout" title="Sair">
	                                    <i class="fa fa-sign-out"></i>                                                                        
	                             	</a>
	                            </li>
	                            
                            <?php } ?>

                        </ul>
                    </div>        
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="<?php echo SIS_URL; ?>">
                            <img src="<?php echo SIS_URL; ?>assets/images/logos/libidinous-transp-white.png" class="logo logo-display" alt="">
                            <img src="<?php echo SIS_URL; ?>assets/images/logos/libidinous-transp-black.png" class="logo logo-scrolled" alt="">
                        </a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li><a href="<?php echo SIS_URL; ?>"><?php echo SIS_TITULO; ?></a></li> 
							<li><a href="<?php echo (!isset($_SESSION['sPersonLogged']) ? SIS_URL."signin/dashboard" : SIS_URL."dashboard"); ?>">anuncie-se!</a></li> 							                   
                            <li><a href="<?php echo SIS_URL; ?>persons">novas pessoas</a></li> 							
                            <li><a href="<?php echo (!isset($_SESSION['sPersonLogged']) ? SIS_URL."plans" : SIS_URL."payment"); ?>">planos</a></li>                                    
                            <li><a href="<?php echo SIS_URL; ?>contact">contato</a></li>                    
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>  
            </nav>