<?php

namespace App\Http\Controllers\Web\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Mail\DemoMail;
use Mail;

class MailController extends Controller
{
    public function index()
    {


        $mailData = [
            'email' => 'm@gmail.com',
            'password' => '0482545708',
        ];
        try {
            Mail::to('msarwat46@gmail.com')->send(new DemoMail($mailData));
            dd("Great! Successfully sent to your mail");
        } catch (\Exception $e) {
            dd("Sorry! Please try again later");
        }
    }


}
