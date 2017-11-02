$(document).ready(function(){

	var myroom;
	//create a new WebSocket object.
	var wsUri = "ws://escort.local:9056/_chat/server.php/" + $personChatPort; 	
	websocket = new WebSocket(wsUri); 	
	websocket.onopen = function(ev) { // connection is open 
		$('#message_box').append("<div class=\"system_msg\">Voc&ecirc; ingressou no Chat de " + $personChatNickname + "!</div>"); //notify user
	}

	$('#message').on('keyup', function(){
		if ($(this).val().length == 1){
			var msg = {
						privated: ($('#private').is(':checked') ? $userChatNickname : 0),		
						message: 'typing_message',
						name: $userChatNickname,
						room : $('#room').val()
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
			alert("Enter Some message Please!");
			return;
		}
		
		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
		//prepare json data
		var msg = {
		privated: privated,		
		message: mymessage,
		name: myname,
		room : myroom
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	});
	
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var dated = msg.dated; //message type
		var umsg = msg.message; //message text
		var uname = msg.name + ' diz'; //user name
		var upriv = (msg.privated != '0' ? ' reservadamente' : '');

		if(type == 'usermsg') 
		{
			$('#message_box').append("<div class=\"user_message_m\">"+uname+upriv+": "+umsg+"<br><span class=\"user_date\">Enviado em "+dated+"</span></div>");
			$('#message').val(''); //reset text
			$('.typing').html(''); //reset typing div
		}
		
		if(type == 'system')
		{
			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
			$('#message').val(''); //reset text
			$('.typing').html(''); //reset typing div
		}
		
		if(type == 'typing' && msg.name != $userChatNickname)
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
		$('#message_box').append("<div class=\"system_error\">Chat n&atilde;o est&aacute; dispon&iacute;vel!</div>");
	}; 
	websocket.onclose 	= function(ev){
		$('#private').attr('disabled', true);		
		$('#message').attr('disabled', true);
		$('#send-btn').attr('disabled', true);
		$('#message_box').append("<div class=\"system_error\">" + $personChatNickname + " n&atilde;o est&aacute; mais online!</div>");
	}; 
});