var psSenderHash;
var cardToken; 
var nomplan;
var valplan; 
var monthplan;
var plaid;

function resetPaymentForm() {
	$('#ct').attr('disabled', false);
  	$('#cn').attr('disabled', false);
  	$('#cm').attr('disabled', false);
  	$('#ca').attr('disabled', false);
  	$('#cs').attr('disabled', false);
  	$('#form-payment').trigger("reset");
  	$('.btn-pay').show();
  	$(".div-boleto").removeClass('hidden');
  	$(".div-installments").addClass('hidden');
}

$('.getplan').on('click', function(){
	$("#loading").fadeIn(500);
	plaid = $(this).data("register");
	nomplan = $(this).data("nomplan");
	valplan = $(this).data("valplan");
	monthplan = $(this).data("monthplan");
	$('.payment-methods').removeClass('hidden');
	if (plaid > 1)
	{		
		$('.nomplan').html('Plano ' + nomplan);
		$('.valplan').html('<strong>R$ ' + parseFloat(valplan).toFixed(2) + ' v&aacute;lido por ' + monthplan + ' ' + (monthplan == 1 ? 'm&ecirc;s' : 'meses') + '</strong>');
		$('.listplans').addClass('hidden');
		$("#loading").fadeOut(500);
		
	}else{
		$.ajax({
	        url: $urlProj + "_actions/payment.php",
	        type: 'POST',
	        data: {method: 'free', plaid: plaid},
	        dataType: "html",
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true){	        		
	        		alert(json.msg);
	        		location.href = $urlProj + "dashboard";	        		
	        	}else{
	        		alert(json.msg);		        	
	        	}
	        	$("#loading").fadeOut(500);
	        },
	        cache: false        
	    });
	}		
});

$(".btn-pay").click(function(e) {
	$("#loading").show();	
	$.ajax({
        url: $urlProj + "_actions/session.php",
        type: "GET",
        dataType : "json",
        cache: false,
        success: function(data){            	
        	if (data.ret == 1)
        	{        		
        		psSenderHash = PagSeguroDirectPayment.getSenderHash();
        		
        		var cc_num = $("input#cn").val().replace(/[^\d]+/g,'');
        		var cc_mes = $("input#cm").val();
        		var cc_ano = $("input#ca").val();
        		var cc_cvv = $("input#cs").val();        		
        		
        		PagSeguroDirectPayment.setSessionId(data.session_id);
        		
        		PagSeguroDirectPayment.getBrand(
        		{
        			  cardBin: cc_num,
        			  success: function(response) {
        				 
        				  var param = {					  	
        							     cardNumber: cc_num,        							
        							expirationMonth: cc_mes,
        							 expirationYear: cc_ano,
        								        cvv: cc_cvv,
        							success: function(response) 
        							{
        								
        								cardToken = response.card.token;
        								
        								PagSeguroDirectPayment.getInstallments(
        						        		{        						        				        						        				
        						        			    amount: valplan,
        						        			    brand: param.brand,
        						        			    maxInstallmentNoInterest: 5,
        						        			    success: function(response){
        						        			    	$('#ct').attr('disabled', true);
        						        			    	$('#cn').attr('disabled', true);
        						        			    	$('#cm').attr('disabled', true);
        						        			    	$('#ca').attr('disabled', true);
        						        			    	$('#cs').attr('disabled', true);
        						        			    	$('.btn-pay').hide();
        						        			    	$(".div-boleto").addClass('hidden');
        						        			    	$(".div-installments").removeClass('hidden');        						        			    	
        						        			    	var installments = $(".installments");
        						        			    	$.each(response.installments[param.brand], function() {
        						        			    		var valueParc = this.installmentAmount;
        						        			    		installments.append($("<option />").val(this.quantity + '|' + this.installmentAmount).text(this.quantity + 'x - R$ ' + valueParc.toFixed(2)));
        						        			    	});         						        			    	
        						        			    },
        						        			    error: function(response) {
        						        			    	resetPaymentForm();       						        			    	
        						        			    	alert('Não foi possível processar seu pedido. Por favor, tente novamente mais tarde!');        						        			    	
        						        			    },
        						        			    complete: function(response) {
        						        			    	//$("#loading").hide();
        						        			    }
        						        		});
        								$("#loading").hide();
        							},
        							error: function(response) {
        								resetPaymentForm();
        		      			    	param = null;
        		      			    	cardToken = null;
        		      			    	alert('Cartão inválido. Por favor, verifique se os dígitos, data de validade e código de segurança estão corretos!');
        		      			    	location.reload();
        							},
        							complete: function(response) {
        								$("#loading").hide();
        							}
        				  }
        				  
        				  param.brand = response.brand.name;   
        				  PagSeguroDirectPayment.createCardToken(param);        				  
        			  },
        			  error: function(response) {
        				resetPaymentForm();
        				alert('Ocorreu um erro ao processar seu pagamento. Por favor, tente novamente!');
        	        	location.reload();
        			  },
        			  complete: function(response) {
        				  $("#loading").hide();
        			  }
        		 });
        		
        	}else{            			
        		alert(data.msg);
        	}        	
        },
        error: function(xhr, ajaxOptions, thrownError) {
        	alert(xhr.status + ' ' + thrownError);
        	$("#loading").hide();
        },
    });
});

$(".btn-confirm").click(function(e) {
	var installment = $('.installments').val();
	var arrInstallment = installment.split('|');
	$("#loading").show();
	$.ajax({
        url: $urlProj + "_actions/payment.php",
        type: "POST",
        data: {'pm': 'CREDIT_CARD',        	   
        	   'sh': psSenderHash, 
        	   'tt': $('#ct').val(),
        	   'ct': cardToken,
        	   'ci': parseInt(arrInstallment[0]),
        	   'pn': plaid,
        	   'pv': parseFloat(arrInstallment[1]),
        	   'pt': valplan
        },
        dataType : "json",
        cache: false,
        success: function(data){
        	alert(data.msg);
        	if (data.ret == 1)   
        		location.href = $urlProj + "dashboard";
        	else
        		location.reload();        		        		
        	$("#loading").hide();
        },
        error: function(xhr, ajaxOptions, thrownError) {
        	alert('Internal Server Error:\r\n' + xhr.responseText + thrownError);
        	//location.reload();
        	$("#loading").hide();
        },
    });
});

$(".btn-boleto").click(function(e) {
	var installment = '1|' + valplan;
	var arrInstallment = installment.split('|');
	psSenderHash = PagSeguroDirectPayment.getSenderHash();
	$("#loading").show();
	$.ajax({
        url: $urlProj + "_actions/payment.php",
        type: "POST",
        data: {'pm': 'BOLETO',
        	   'sh': psSenderHash,        	
        	   'ci': parseInt(arrInstallment[0]),
        	   'pn': plaid,
        	   'pv': parseFloat(arrInstallment[1]),
        	   'pt': valplan
        },
        dataType : "json",
        cache: false,
        success: function(data){            	
        	alert('Um boleto para pagamento foi encaminhando para seu E-mail!');
        	if (data.ret == 1)   
        		location.href = $urlProj + "dashboard";
        	else
        		location.reload();        		        		
        	$("#loading").hide();
        },
        error: function(xhr, ajaxOptions, thrownError) {
        	alert('Ocorreu um erro ao processar seu pagamento. Por favor, tente novamente!');
        	location.reload();
        },
    });
});