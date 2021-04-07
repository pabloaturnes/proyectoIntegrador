<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Consulta;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller
{
    public function index()
    {
        return view('web.contacto');
    }

    public function guardar(Request $request){
        $msg = "Te estaremos contactando a la brevedad";
        $consulta = new Consulta();
        $consulta->email = $request->input("txtEmail");
        $consulta->nombre = $request->input("txtNombre");
        $consulta->telefono = $request->input("txtTelefono");
        $consulta->fecha = date("Y-m-d");
        $consulta->consulta = $request->input("txtConsulta");
        //$consulta->archivo = 
        $consulta->insertar();
        $mail = new PHPMailer(true);
        $mail->SMTPDebub = 0;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = env('MAIL_HOST'); // SMTP a utilizar
        $mail->SMTPAuth = true; 
        $mail->Username = 'pedidos@jennifersalazar.com.ar'; // Correo completo a utilizar
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
        //$mail->send();
        return view(('web.confirmacion'), compact('msg'));
    }
}
