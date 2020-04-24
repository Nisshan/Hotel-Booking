<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class MailController
 * @package App\Http\Controllers\Frontend
 */
class MailController extends Controller
{
    /**
     * @param Request $request
     */
//    public function sendMail(Request $request)
//    {
//        Mail::send('mail.send-mail',
//            array(
//                'name' => $request->name,
//                'number' => $request->phone_number,
//                'email' => $request->email,
//                'from' => $request->from,
//                'to' => $request->to,
//            ), function ($message) {
//                $message->to('bishwasilocons@gmail.com');
//            });
//    }
}
