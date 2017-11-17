$(document).ready(function(){

	var myroom;
	//create a new WebSocket object.
	var wsUri = "ws://escort.local:9056/_chat/server.php/" + $personChatPort; 	
	websocket = new WebSocket(wsUri); 	
	websocket.onopen = function(ev) { // connection is open 
		var welcome = ($chatGender == 'M' ? 'Bem vindo' : 'Bem vinda');
		if ($personChatNickname != $userChatNickname)
			$('#message_box').append("<div class=\"system_msg\">Voc&ecirc; ingressou no Chat de " + $personChatNickname + "!</div>"); //notify user
		else
			$('#message_box').append("<div class=\"system_msg\">" + welcome + " ao seu Chat!</div>"); //notify user
	}

	$('#message').on('keyup', function(){
		if ($(this).val().length == 3){
			var msg = {
						privated: ($('#private').is(':checked') ? $userChatNickname : 0),		
						message: 'typing_message',
						name: $userChatNickname,
						room : $('#room').val(),
						gender : ($chatGender == 'M' ? 'm' : 'f')
						};			
			websocket.send(JSON.stringify(msg));
		}
	});
	
	$('#send-btn').click(function(){ //use clicks message send button			
		var mymessage = $('#message').val(); //get message text
		var myname = $userChatNickname; //get user name
		var myroom = $('#room').val(); //get Room ID		
		var privated = ($('#private').is(':checked') ? myname : 0); //get Privated Chat
						
		if(mymessage == ""){ //emtpy message?
			alert("Digite uma mensagem para poder enviar!");
			return;
		}
		
		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
		//prepare json data
		var msg = {
		privated: privated,		
		message: mymessage,
		name: myname,
		gender: ($chatGender == 'M' ? 'm' : 'f'),
		room : myroom
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
		$('#message').val(''); //reset text
	});
	
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var dated = msg.dated; //message type
		var umsg = msg.message; //message text		
		var sendername = $userChatNickname; //sender name
		var gender = msg.gender; //gender sender
		var uname = (sendername == msg.name ? 'Voc&ecirc' : msg.name); //user name
		var upriv = (msg.privated != '0' ? ' reservadamente para ' + (sendername == $personChatNickname ? 'voc&ecirc;' : $personChatNickname) : '');		

		if((type == 'usermsg' && msg.privated == '0') || (type == 'usermsg' && msg.privated != '0' && (msg.privated == sendername || sendername == $personChatNickname))) 
		{			
			$('#message_box').append("<div class=\"user_message_"+(gender)+"\">"+uname+upriv+": "+umsg+"<br><span class=\"user_date\">Enviado em "+dated+"</span></div>");
			$('#message').val(''); //reset text
			$('.typing').html(''); //reset typing div
		}
		
		if(type == 'system')
		{
			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
			$('#message').val(''); //reset text
			$('.typing').html(''); //reset typing div
		}
		
		if(type == 'typing' && msg.name != $userChatNickname && msg.privated == '0')
		{
			$('.typing').html(msg.name + " est&aacute; digitando...");
		}
		
		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
	};
	
	websocket.onerror	= function(ev){
		$('#private').attr('disabled', true);		
		$('#message').attr('disabled', true);
		$('#send-btn').attr('disabled', true);
		$('#message_box').append("<div class=\"system_error\">Chat n&atilde;o est&aacute; dispon&iacute;vel no momento!</div>");
	}; 
	websocket.onclose 	= function(ev){
		$('#private').attr('disabled', true);		
		$('#message').attr('disabled', true);
		$('#send-btn').attr('disabled', true);
		//$('#message_box').append("<div class=\"system_error\">" + $personChatNickname + " n&atilde;o est&aacute; online!</div>");
	}; 
});