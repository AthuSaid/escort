
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

$('#form-user-signin-page').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/user-signin.php",
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

$('#form-user-signup').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/user-signup.php",
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

$('#form-user-signup-page').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/user-signup.php?mtd=pre",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = $urlProj + "user-signup"
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

$('#form-test').validator().on('submit', function(e){	
	var formData = new FormData(this);
	if (e.isDefaultPrevented()) {
		return false;
	}else{
		e.preventDefault();
		$("#loading").fadeIn(500); 
		$.ajax({
	        url: $urlProj + "_actions/testimonial.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true)
	        		location.href = $urlProj + "profile";
	        	else{
	        		$('.' + json.field).addClass('form-error-ajax');
		        	$('.' + json.field).html('<ul class="list-unstyled"><li>' + json.msg + '</li></ul>');
		        	$('.' + json.field).addClass('label-error-ajax');
		        	$("#loading").fadeOut(500);		        	
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false
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
	        			$('.btnads').html('<a href="' + $urlProj + 'ad" class="btn btn-primary m-top-30 next">Inserir Novo An&uacute;ncio <i class="fa fa-plus"></i></a>');	
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

$('.remove-test').on('click', function(){
	if(confirm('Deseja mesmo remover este depoimento?'))
	{ 
		$("#loading").fadeIn(500);
		var tesid = $(this).data("register");
		$.ajax({
	        url: $urlProj + "_actions/testimonial.php",
	        type: 'POST',
	        data: {method: 'delete', tesid: tesid},
	        dataType: "html",
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true){
	        		$('.item-' + tesid).remove();	        		
	        	}else{
	        		alert('Erro ao excluir o depoimento!');		        	
	        	}
	        	$("#loading").fadeOut(500);
	        },
	        cache: false        
	    });
	}	
});

$('.save-test').on('click', function(){
	if(confirm('Confirma salvar este depoimento e publicar no seu perfil?'))
	{ 
		$("#loading").fadeIn(500);
		var tesid = $(this).data("register");
		var replica = $("#replica-" + tesid).val();
		$.ajax({
	        url: $urlProj + "_actions/testimonial.php",
	        type: 'POST',
	        data: {method: 'update', tesid: tesid, replica : replica},
	        dataType: "html",
	        success: function (data) {
	        	location.reload();	        	
	        },
	        cache: false        
	    });
	}	
});

$('.add-test').on('click', function(){
	$("#loading").fadeIn(500);
	var tesid = $(this).data("register");
	$('.txt-test-' + tesid).removeClass('hidden');
	$('.btn-test-' + tesid).removeClass('hidden');
	$("#loading").fadeOut(500);	       
});

$('.cancel-test').on('click', function(){
	var tesid = $(this).data("register");
	$('.txt-test-' + tesid).addClass('hidden');
	$('.btn-test-' + tesid).addClass('hidden');     
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
	
