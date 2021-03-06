<?php 

namespace App\Http\Helpers;
use Mail;

class sendMail {
    
    private $mail;
    
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    public function welcomeMessage($data)
    {
        //get the user's first name from the fullname value
        $firstName = explode(" ", $data['fullName']);
        
        $mail["title"] = "Welcome to ".env('APP_NAME');
        $mail["salute"] = "Hello ".$firstName[0].",";
        
        $mail["message"] = "<center>Thank you for joining ".env('APP_NAME');
        $mail["message"] .= "<br>You can have an introduction of your app here, really express yourself";
        $mail["message"] .= "<br>because here is where you get to explain yourself, paint a picture";
        $mail["message"] .= "<br>of the capability of your app to the user";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
        });
    }

}