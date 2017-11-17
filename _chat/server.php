<?php
session_start();

$phisicalPath = "c:/xampp/htdocs/escort";
//$phisicalPath = "/var/www/html";

require_once $phisicalPath."/_includes/_config/config.ini.php";

$autoloadFuncs = spl_autoload_functions();

foreach($autoloadFuncs as $unregisterFunc){
	spl_autoload_unregister($unregisterFunc);
}

spl_autoload_register(function ($class_name) {
	global $phisicalPath;
	require_once $phisicalPath."/_includes/_classes/".$class_name.".class.php";
});

$functions = new functions();

$host = 'escort.local'; //host
$port = 9056; //port
$null = NULL; //null var

//Create TCP/IP sream socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//reuseable port
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
//bind socket to specified host
socket_bind($socket, 0, $port);
//listen to port
socket_listen($socket);
//create & add listning socket to the list
$clients = array($socket);
//start endless loop, so that our script doesn't stop
while (true) {
	//manage multipal connections
	$changed = $clients;
	//returns the socket resources in $changed array
	socket_select($changed, $null, $null, 0, 10);	
	//check for new socket
	if (in_array($socket, $changed)) {

		$socket_new = socket_accept($socket); //accpet new socket
		
		$clients[] = $socket_new; //add socket to client array
		
		$header = socket_read($socket_new, 1024); //read data sent by the socket
		
		// get User Name for first moment to connect in chat
		$headers = array();
		$lines = preg_split("/\r\n/", $header);
		foreach($lines as $line)
		{
			$line = chop($line);
			if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
			{
				if ($matches[1] == 'Cookie'){
					
					$regExp = explode("; ", $matches[2]);
					
					foreach ($regExp as $expression)
					{						
						preg_match('/\A(\S+)=(.*)\z/', $expression, $matches1, PREG_OFFSET_CAPTURE, 0);
																			
						if($matches1[1][0] == 'cUserNickname')
						{
							$userLoggedChat = $matches1[2][0];
							break;
						}
					}
				}	
			}
		}
		
		//print_r($header);
		//read header to GET port/room of chat
		$lines = preg_split("/\r\n/", $header);
		foreach($lines as $line)
		{
			$line = chop($line);
			if (substr($line, 0, 3) == 'GET')
				$myPort = explode("/", substr(str_replace('HTTP/1.1', '', $line), 4));
				//print_r($myPort);
		}
		
		perform_handshaking($header, $socket_new, $host, $port); //perform websocket handshake
		
		socket_getpeername($socket_new, $ip); //get ip address of connected socket
		
		$jsonMessage = json_encode(array('type'=>'system', 'message'=> $userLoggedChat.' entrou no chat!'));
		
		$response = mask($jsonMessage); //prepare json data
		send_message($response); //notify all users about new connection
		$functions->fSaveChat($jsonMessage, end($myPort)); //save chat LOG into database
		
		//make room for new socket
		$found_socket = array_search($socket, $changed);		
		unset($changed[$found_socket]);
	}
	
	//loop through all connected sockets
	foreach ($changed as $changed_socket) {	
		
		//check for any incomming data
		while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
		{
			$received_text = unmask($buf); //unmask data
			$tst_msg = json_decode($received_text); //json decode 
			$user_name = $tst_msg->name; //sender name
			$user_message = $tst_msg->message; //message text
			$user_room = $tst_msg->room; //Room ID
			$gender = $tst_msg->gender; //gender sender
			$privated_chat = $tst_msg->privated; //Privated Chat
			
			//prepare data to be sent to client
			
			if ($user_message == 'typing_message'){

				$jsonMessage = json_encode(array('type'		=>'typing',
												'privated' 	=> $privated_chat,
												'dated'		=> date('d/m/Y H:i:s'),
												'name'		=> $user_name,
												'gender'    => $gender,
												'message'	=> null));
				
				
			}else{
				
				$jsonMessage = json_encode(array('type'		=>'usermsg',
												'privated' => $privated_chat,
												'dated'	=> date('d/m/Y H:i:s'),
												'name'		=> $user_name,
												'gender'    => $gender,
												'message'	=> $functions->fStripTagsContent($user_message, '', false, true)));
					
			}
			
			//print_r($jsonMessage);
			$response_text = mask($jsonMessage);
			
			if ($user_name !== $null)
			{
				if ((int)$user_room == (int)end($myPort))
				{	
					/*echo '\nportas comparativo: '.$privated_chat.' --> '.$userLoggedChat;
					if ($privated_chat != '0'){ //show privated messages only for sender and Person
						if ($privated_chat == $userLoggedChat)
							send_message($response_text); //send data
						elseif ($user_name == $privated_chat)
							send_message($response_text); //send data
					}else{*/
						send_message($response_text); //send data
					//}
					//save chat LOG into database
					if ($user_message != 'typing_message')
						$functions->fSaveChat($jsonMessage, end($myPort));
				}	
			}		
			break 2; //exist this loop
		}
		
		$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
		if ($buf === false) { // check disconnected client
			// remove client for $clients array
			$found_socket = array_search($changed_socket, $clients);
			socket_getpeername($changed_socket, $ip);
			unset($clients[$found_socket]);
			
			//notify all users about disconnected connection
			$jsonMessage = json_encode(array('type'=>'system', 'message'=>$user_name.' saiu do chat!'));
			$response = mask($jsonMessage);
			send_message($response);
			//save chat LOG into database
			$functions->fSaveChat($jsonMessage, end($myPort));
		}
	}
}
// close the listening socket
socket_close($socket);

function send_message($msg)
{
	global $clients;
	foreach($clients as $changed_socket)
	{		
		@socket_write($changed_socket, $msg, strlen($msg));
	}		
	return true;
}


//Unmask incoming framed message
function unmask($text) {
	$length = ord($text[1]) & 127;
	if($length == 126) {
		$masks = substr($text, 4, 4);
		$data = substr($text, 8);
	}
	elseif($length == 127) {
		$masks = substr($text, 10, 4);
		$data = substr($text, 14);
	}
	else {
		$masks = substr($text, 2, 4);
		$data = substr($text, 6);
	}
	$text = "";
	for ($i = 0; $i < strlen($data); ++$i) {
		$text .= $data[$i] ^ $masks[$i%4];
	}
	return $text;
}

//Encode message for transfer to client.
function mask($text)
{
	$b1 = 0x80 | (0x1 & 0x0f);
	$length = strlen($text);
	
	if($length <= 125)
		$header = pack('CC', $b1, $length);
	elseif($length > 125 && $length < 65536)
		$header = pack('CCn', $b1, 126, $length);
	elseif($length >= 65536)
		$header = pack('CCNN', $b1, 127, $length);
	return $header.$text;
}

//handshake new client.
function perform_handshaking($receved_header,$client_conn, $host, $port)
{
	$headers = array();
	$lines = preg_split("/\r\n/", $receved_header);
	foreach($lines as $line)
	{
		$line = chop($line);
		if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
		{
			$headers[$matches[1]] = $matches[2];
		}
	}

	$secKey = $headers['Sec-WebSocket-Key'];
	$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
	//hand shaking header
	$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"WebSocket-Origin: $host\r\n" .
	"WebSocket-Location: ws://$host:$port/_chat/server.php\r\n".
	"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
	socket_write($client_conn,$upgrade,strlen($upgrade));
}


