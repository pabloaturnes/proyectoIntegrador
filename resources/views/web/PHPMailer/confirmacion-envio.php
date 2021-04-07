<?php


$mail = new PHPMailer(true);
        $mail->SMTPDebub = 0;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = env('MAIL_HOST'); // SMTP a utilizar
        $mail->SMTPAuth = true; 
        $mail->Username = env('pedidos@jennifersalazar.com.ar'); // Correo completo a utilizar
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');

        //Destinatarios
        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));//Direccion desde
        $mail->addAddress($email);//Direccion para
        $mail->addReplyTo($replyTo);//Direccion de replly no-replu
        $mail->addBCC($copiaOculta); //Copia oculta

        //Contenido del mail
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
?>