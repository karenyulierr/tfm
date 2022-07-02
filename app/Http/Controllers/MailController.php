<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;



class MailController extends Controller
{
    public function contact(Request $request)
    {
        Mail::send('email', [
            'name' => $request->name,
            'email' => $request->email,
            'msg' => $request->msg,

        ], function ($mail) use ($request) {
            $mail->to("karen_rodriguezca@fet.edu.co")->subject('Correo desde TuriApp');
        });
        return redirect('contact')->with('mensaje', 'Información enviada correctamente, pronto nos podremos en contacto contigo, gracias por comunicarte con TuriApp');
    }
}
