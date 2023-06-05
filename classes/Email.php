<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email{
    protected $email;
    protected $nombre;
    protected $token;
    public function __construct($email,$nombre,$token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'e47191c9728a31';
        $mail->Password = '7b1f4cdceaa6e8';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress('cuentas@uptask.com','uptask.com');
        $mail->Subject = 'Confirma tu cuenta';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong>. Has creado tu cuenta en Uptask.</p>';
        $contenido .= '<p>Solo debes confirmarla en el siguiente link: </p>';
        $contenido .= '<a href="http://localhost:3000/confirmar?token=';
        $contenido .= $this->token . '">Confirmar cuenta</a>';
        $contenido .= '<p>Si tu no creaste esta cuenta, puedes ignorar el mensaje</p>';
        $contenido .= '<html>';

        $mail->Body = $contenido;
        $mail->send();
    }
}