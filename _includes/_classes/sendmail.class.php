<?php
	//require_once('class.phpmailer.php');
	require_once "class.phpmailer.php";

class sendmail{
	
	public $nomeEmail;
	public $paraEmail;
	public $assuntoEmail;
	public $conteudoEmail;
	public $confirmacao;
	public $mensagem;
	public $anexo;
	public $copiaEmail;
	public $copiaOculta;
	public $copiaNome;
	public $nomeCopiaOculta;
	public $configHost;
	public $configPort;
	public $configUsuario;
	public $configSenha;
	public $remetenteEmail;
	public $remetenteNome;
	public $erroMsg;
	public $confirmacaoErro;
    public $nomeReplyTo;
    public $replyTo;

	function enviar(){
		// Inicia a classe PHPMailer
		$mail = new mailer();
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = $this->configHost; // Endereço do servidor SMTP
		$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
		$mail->Port = $this->configPort;
		$mail->Username = $this->configUsuario; // Usuário do servidor SMTP
		$mail->Password = $this->configSenha; // Senha do servidor SMTP
	
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = $this->remetenteEmail; // Seu e-mail
		$mail->FromName = $this->remetenteNome; // Seu nome
		
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		if(isset($this->paraEmail)){
			$mail->AddAddress(''. $this->paraEmail. '',''.$this->nomeEmail.'');
		}
		if(isset($this->copiaEmail)){
			$mail->AddCC(''.$this->copiaEmail.'', ''.$this->copiaNome.''); // Copia
		}
		if(isset($this->copiaOculta)){
			$mail->AddBCC(''.$this->copiaOculta.'', ''.$this->nomeCopiaOculta.''); // Cópia Oculta
		}
        if(isset($this->replyTo)){
			$mail->AddReplyTo(''. $this->replyTo. '',''.$this->nomeReplyTo.'');
		}
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
		
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject = "".$this->assuntoEmail.""; // Assunto da mensagem
		$mail->Body = "".$this->conteudoEmail."";// Conteudo da mensagem a ser enviada
		$mail->AltBody = "Por favor verifique seu leitor de email.";
	
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		if(!empty($this->anexo)){
			$mail->AddAttachment("".$this->anexo.""); // Insere um anexo
		}
		// Envia o e-mail
		$enviado = $mail->Send();
		
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
	
		// Exibe uma mensagem de resultado
		if($this->confirmacao == 1){
			if ($enviado) {
				echo $this->mensagem;
			} else {
				echo $this->erroMsg;
				if($this->confirmacaoErro == 1){
					echo "Informações do erro:" . $mail->ErrorInfo;
				}
			}
		}
	}
}?>