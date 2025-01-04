<?php

namespace app\src;

use PHPMailer\PHPMailer\PHPMailer;
use app\templates\Template;

class Email{

    private $data;
    private $template;


    private function config(){
        return (object) Load::file('/config.php');
    }

    public function data(array $data){
        $this->data = (object)$data;

        return $this;
    }

    public function template(Template $template){
        if(!isset($this->data)){
            throw new \Exception("Antes de chamar o template, passe os dados através do metodo data");
        }

        $this->template = $template->run($this->data);

        return $this;
    }

    public function send(){

        if(!isset($this->template)){
            throw new \Exception("Por favor, antes de enviar o email escolha um template com o método template");
            
        }

        $mailer = new PHPMailer;

        $config = (object)$this->config()->email; //Transforma o array em objeto 

        $mailer->SMTPDebug = 2;                      //Enable verbose debug output
        $mailer->isSMTP();                                            //Send using SMTP
        $mailer->Host       = $config->host;                     //Set the SMTP server to send through
        $mailer->SMTPAuth = true;
        $mailer->Username   = $config->username;                     //SMTP username
        $mailer->Password   = $config->password;                               //SMTP password
        $mailer->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mailer->Port       = $config->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mailer->CharSet = "UTF-8";

        //Recipients
        $mailer->setFrom($this->data->fromEmail, $this->data->fromName);
        $mailer->addAddress($this->data->toEmail, $this->data->toName);     //Para quem está enviando

        
        //Content
        $mailer->isHTML(true);                                  //Set email format to HTML
        $mailer->Subject = $this->data->assunto;
        $mailer->Body    = $this->template;
        $mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        $mailer->send();
    }                               //Enable SMTP authentication
}