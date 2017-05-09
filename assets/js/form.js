
$('#form-contact').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/contact.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	alert(json.msg);
	        	if(json.ret == true)
	        		location.href = $urlProj + "home"
	        	else{	        		
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });				
	}
});

$('#form-retrieve').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/retrieve.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	alert(json.msg);
	        	if(json.ret == true)
	        		location.href = $urlProj + "dashboard"
	        	else{	        		
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });				
	}
});

$('#form-signin').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/signin.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = $urlProj + "dashboard"
	        	else{
	        		$('.frm-' + json.field).addClass('form-error-ajax');
		        	$('.' + json.field).html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
		        	$('.' + json.field).addClass('label-error-ajax');
		        	$('.frm-' + json.field).val('');
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });				
	}
});

$('#form-signin-page').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/signin.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = $urlProj + json.url;
	        	else{
	        		$('.frm-' + json.field).addClass('form-error-ajax');
		        	$('.' + json.field).html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
		        	$('.' + json.field).addClass('label-error-ajax');
		        	$('.frm-' + json.field).val('');
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });				
	}
});

$('#form-signup').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/signup.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = $urlProj + json.url;
	        	else{
	        		$('.' + json.field).addClass('form-error-ajax');
		        	$('.' + json.field).html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
		        	$('.' + json.field).addClass('label-error-ajax');
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false,
	        xhr: function() {  // Custom XMLHttpRequest
	            var myXhr = $.ajaxSettings.xhr();
	            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
	                myXhr.upload.addEventListener('progress', function () {
	                    /* faz alguma coisa durante o progresso do upload */
	                }, false);
	            }
	        return myXhr;
	        }
	    });				
	}
});

$('#form-signup-page').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/signup.php?mtd=pre",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = $urlProj + "signup"
	        	else{
	        		$('.frm-' + json.field).addClass('form-error-ajax');
		        	$('.' + json.field).html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
		        	$('.' + json.field).addClass('label-error-ajax');
		        	$('.frm-' + json.field).val('');
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false,
	        xhr: function() {  // Custom XMLHttpRequest
	            var myXhr = $.ajaxSettings.xhr();
	            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
	                myXhr.upload.addEventListener('progress', function () {
	                    /* faz alguma coisa durante o progresso do upload */
	                }, false);
	            }
	        return myXhr;
	        }
	    });				
	}
});


$('#form-ad').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/ad.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = "../../person/" + json.url + "/" + json.title;
	        	else{
	        		$('.' + json.field).addClass('form-error-ajax');
		        	$('.' + json.field).html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
		        	$('.' + json.field).addClass('label-error-ajax');
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false,
	        xhr: function() {  // Custom XMLHttpRequest
	            var myXhr = $.ajaxSettings.xhr();
	            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
	                myXhr.upload.addEventListener('progress', function () {
	                    /* faz alguma coisa durante o progresso do upload */
	                }, false);
	            }
	        return myXhr;
	        }
	    });				
	}
});

$('.remove-ad').on('click', function(){
	if(confirm('Deseja mesmo remover este an\u00fancio?\nTodas as fotos e informa\u00e7\u00f5es ser\u00e3o removidas!'))
	{ 
		$("#loading").fadeIn(500);
		var apid = $(this).data("register");
		$.ajax({
	        url: $urlProj + "_actions/ad.php",
	        type: 'POST',
	        data: {method: 'delete', apid: apid},
	        dataType: "html",
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true){
	        		$('.item-' + apid).remove();
	        		if (json.shownewad == true){
	        			$('.btnads').html('<a href="' + $urlProj + 'signout" class="btn btn-warning m-top-30 cancel">Logout <i class="fa fa-sign-out"></i></a>' + 
	        							  '<a href="' + $urlProj + 'ad" class="btn btn-primary m-top-30 next">Inserir Novo An&uacute;ncio <i class="fa fa-plus"></i></a>');	
	        		}
	        	}else{
	        		alert('Erro ao excluir o anuncio!');		        	
	        	}
	        	$("#loading").fadeOut(500);
	        },
	        cache: false        
	    });
	}	
});

$('.resetpwd').on('click', function(){	
	$("#loading").fadeIn(500); 
	var email = $('.eml').val();
	$.ajax({
        url: $urlProj + "_actions/remember.php",
        type: 'POST',
        data: {email: email},
        dataType: "html",
        success: function (data) {
        	var json = $.parseJSON(data);
        	if(json.ret == true){
        		alert('Verifique seu email ' + email + ' com os procedimentos de gerar nova senha!');
        		$('.passw').removeClass('hidden');
	        	$('.signin').removeClass('hidden');
	        	$('.cancel').addClass('hidden');	        	
	        	$('.resetpwd').addClass('hidden');
	        	$('.remember').removeClass('hidden');
	        	$('.apls').html('<i class="fa fa-lock"></i> Acesso ao Portal');	
	        	$('.login').removeClass('label-error-ajax');
	        	$('.eml').removeClass('form-error-ajax');
	        	$('.eml').val('');
        	}else{
        		$('.eml').addClass('form-error-ajax');
	        	$('.login').html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
	        	$('.login').addClass('label-error-ajax');	
	        	$('.eml').val('');
        	}
        	$("#loading").fadeOut(500);
        },
        cache: false        
    });
});
	
