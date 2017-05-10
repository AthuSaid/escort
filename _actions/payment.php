<?php
session_start();

error_reporting(0);

set_time_limit(0);

date_default_timezone_set('America/Sao_Paulo');

include_once $_SERVER['DOCUMENT_ROOT']."/_includes/_config/config.ini.php";

$functions = new functions();

$_POST = $functions->fSanitizeRequest($_POST);

$retSender = $functions->fQueryPersonRegister($_SESSION['sPersonUrl']);

if (!empty($retSender[0]['whatsapp']))
	$telefone = $retSender[0]['whatsapp'];
elseif (!empty($retSender[0]['tel1']))
	$telefone = $retSender[0]['tel1'];
elseif (!empty($retSender[0]['tel2']))
	$telefone = $retSender[0]['tel2'];	
	
$retPlan = $functions->fQueryPlans(1, $_POST['pn']);

$paymentMethod = $_POST['pm'];

$autoloadFuncs = spl_autoload_functions();

foreach($autoloadFuncs as $unregisterFunc)
{
	spl_autoload_unregister($unregisterFunc);
}

include $_SERVER['DOCUMENT_ROOT']."/_includes/PagSeguroLibrary/PagSeguroLibrary.php";

spl_autoload_register(function ($class_name) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/PagSeguroLibrary/".$class_name.".php";
});

if ($_POST['method'] != 'free') //Only paid plans - Invoke PagSeguro Payment Gateway
{
	
	$directPaymentRequest = new PagSeguroDirectPaymentRequest();
	
	$directPaymentRequest->setPaymentMode('DEFAULT');
	
	$directPaymentRequest->setPaymentMethod($paymentMethod);
	
	$directPaymentRequest->setReceiverEmail('mailbotfacil@gmail.com');
	
	$directPaymentRequest->setCurrency("BRL");
	
	$directPaymentRequest->addItem('0001', "Plano ".$retPlan[0]['plano'], 1,  $_POST['pt']);
	
	$directPaymentRequest->setReference("Plano ".$retPlan[0]['plano']." - R$ ".$retPlan[0]['valor']);
	
	$directPaymentRequest->setSender(
			$retSender[0]['nome'],
			$retSender[0]['email'],
			substr($telefone, 1, 2),
			str_replace("-", "", substr($telefone, 5, 9)),
			'CPF',
			$retSender[0]['cpf'],
			true);
			
	$directPaymentRequest->setSenderHash($_POST['sh']);
	
	$sedexCode = PagSeguroShippingType::getCodeByType('NOT_SPECIFIED');
	
	$directPaymentRequest->setShippingType($sedexCode);
	
	$directPaymentRequest->setShippingAddress(
			'08780-000',
			'RUA DAS FLORES',
			'123',
			'',
			'CENTRO',
			'SAO PAULO',
			'SP',
			'BRA');
	
	$paymentMethodLabel = "Boleto";
	
	if ($paymentMethod == "CREDIT_CARD")
	{
		$paymentMethodLabel = "Cart&atilde;o de Cr&eacute;dito";
		
		$billing = new PagSeguroBilling(
						array('postalCode' 	=> '08780-000',
							  'street' 		=> 'RUA DAS FLORES',
							  'number' 		=> '123',
							  'complement' 	=> '',
							  'district' 	=> 'CENTRO',
							  'city' 		=> 'SAO PAULO',
							  'state' 		=> 'SP',
							  'country' 	=> 'BRA'));
		
		$installment = new PagSeguroDirectPaymentInstallment(
							array('quantity'					  => $_POST['ci'],
								  'value' 						  => $_POST['pv'],
								  'noInterestInstallmentQuantity' => SIS_PARCELAS_SEM_JUROS));
							
		$arrDocuments = array('type' => 'CPF', 'value' => $retSender[0]['cpf']);	
		
		$holder = new PagSeguroCreditCardHolder(
					   array('name' 	 => $_POST['tt'],
							 'documents' => $arrDocuments,
							 'birthDate' => $retSender[0]['nascimento'],
							 'areaCode'  => substr($telefone, 1, 2),
							 'number' 	 => str_replace("-", "", substr($telefone, 5, 9))));
		
		$cardCheckout = new PagSeguroCreditCardCheckout(
							 array('token' 		 => $_POST['ct'],
								   'installment' => $installment,
								   'billing' 	 => $billing,
								   'holder' 	 => $holder));
		
		$directPaymentRequest->setCreditCard($cardCheckout);
	}
											 
	if ($paymentMethod == "EFT")
	{
		$paymentMethodLabel = "D&eacute;bito Online";
		
		$directPaymentRequest->setOnlineDebit(array("bankName" => 'ITAU'));
	}
	
	try {
	
		$credentials = PagSeguroConfig::getAccountCredentials();
	
		$return = $directPaymentRequest->register($credentials);
	
		require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/PHPMailerAutoload.php";
		spl_autoload_register(function ($class_name) {
			require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/".$class_name.".class.php";
		});
		
		$email = new email();
				
		if ($return)
		{
			$arrPlano = array("plaid"   			=> $retPlan[0]['plaid'],
							  "name" 				=> $retPlan[0]['plano'],
							  "ads" 				=> $retPlan[0]['anuncios'],
							  "photos" 				=> $retPlan[0]['fotos'],
							  "videos" 				=> $retPlan[0]['videos'],
							  "psid"                => $return->getCode(),
							  "vloriginal"			=> $return->getGrossAmount(),
							  "vencimento"			=> date('Y-m-d H:i:s', strtotime("+".$retPlan[0]['cobrancadias']." day")));
	
			if($functions->fQuerySavePersonPlan($arrPlano))
			{
				$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
						Ol&aacute; '.$functions->fReduceName($_SESSION['sPersonUrl']).',<br><br>
						Seu Plano '.$retPlan[0]['plano'].' no '.SIS_TITULO.' foi inclu&iacute;do com sucesso!<br>
							<strong>Plano '.$retPlan[0]['plano'].'</strong> no valor de 
							<strong>R$ '.number_format($return->getGrossAmount(), 2, ",", ".").'</strong> com vencimento em 
							<strong>'.date('d/m/Y', strtotime("+".$retPlan[0]['cobrancadias']." day")).'</strong><br>
						Com este plano voc&ecirc; poder&aacute; incluir at&eacute; '.$retPlan[0]['anuncios'].' an&uacute;ncios no site, <br>
						bem como '.($retPlan[0]['fotos'] == 999 ? 'fotos ilimitadas' : 'at&eacute; '.$retPlan[0]['fotos'].' fotos').' e 
								 '.($retPlan[0]['videos'] == 999 ? 'v&iacute;deos ilimitados' : 'at&eacute; '.$retPlan[0]['videos'].' v&iacute;deos').'! <br>
						Caso deseje acessar sua conta, clique no link abaixo:<br><br>
						<a href="'.SIS_URL.'signin/dashboard">'.SIS_URL.'signin/dashboard</a><br><br>
						Atenciosamente,<br>
						Equipe '.SIS_TITULO.'.<br><br>
						<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
					';
			
				$arrEmail = array('aka' => $_SESSION['sPersonUrl'],
								  'email' => $_SESSION['sPersonEmail'],
								  'subject' => SIS_TITULO.' - Plano '.$retPlan[0]['plano'].' Contratado!',
								  'message' => $message);
					
				$email->fSendEmailToPerson($arrEmail);
				 
				echo json_encode(array("ret" => 1, "msg" => "Sua compra foi processada com sucesso!"));
				 
			}else{
				 
				echo json_encode(array("ret" => 0, "msg" => "Ocorreu um erro ao efetuar sua compra com {$paymentMethodLabel}.\n\nPor favor, tente novamente mais tarde!"));
			}
		}
	
	} catch (PagSeguroServiceException $e) {
	
		$catchError = $e->getMessage();
	
		echo json_encode(array("ret" => 0, "msg" => "Ocorreu um erro ao efetuar sua compra com {$paymentMethodLabel}.\n\n{$catchError}\n\nPor favor, preencha os campos corretamente!"));
	}
	
}else{ // Only N days free plan
	
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/PHPMailerAutoload.php";
	spl_autoload_register(function ($class_name) {
		require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/".$class_name.".class.php";
	});
	
	$email = new email();
		
	$arrPlano = array("plaid" 		=> $retPlan[0]['plaid'],
					  "name" 		=> $retPlan[0]['plano'],
					  "ads" 		=> $retPlan[0]['anuncios'],
					  "photos" 		=> $retPlan[0]['fotos'],
					  "videos" 		=> $retPlan[0]['videos'],				
					  "vloriginal" 	=> 0,
					  "vencimento" 	=> date('Y-m-d H:i:s', strtotime("+".SIS_DIAS_GRATIS." day")));
	
	if($functions->fQuerySavePersonPlan($arrPlano))
	{
		$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
						Ol&aacute; '.$functions->fReduceName($_SESSION['sPersonUrl']).',<br><br>
						Seu Plano Basic de '.SIS_DIAS_GRATIS.' dias gr&aacute;tis no '.SIS_TITULO.' foi criado com sucesso!<br>
						Com este plano voc&ecirc; poder&aacute; incluir at&eacute; 1 (um) an&uacute;ncio no site <br>
						cujo mesmo estar&aacute; online, se aprovado, por no m&aacute;ximo '.SIS_DIAS_GRATIS.' dias corridos! <br><br>
						Atenciosamente,<br>
						Equipe '.SIS_TITULO.'.<br><br>
						<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
					';
			
		$arrEmail = array('aka' => $_SESSION['sPersonUrl'],
						  'email' => $_SESSION['sPersonEmail'],
						  'subject' => SIS_TITULO.' - Plano Basic por '.SIS_DIAS_GRATIS.' Dias',
						  'message' => $message);
			
		$email->fSendEmailToPerson($arrEmail);
			
		echo json_encode(array("ret" => 1, "msg" => "Seu plano de 30 dias foi assinado com sucesso!"));
			
	}else{
			
		echo json_encode(array("ret" => 0, "msg" => "Ocorreu um erro ao assinar seu plano. Por favor tente novamente mais tarde!"));
	}
	
}