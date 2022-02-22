<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendMail
 * @package App\Mail
 */
class SendMail extends Mailable
{
    use Queueable;
    use SerializesModels;
    public Mixed $response;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mixed $response)
    {
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return SendMail
     */
    public function build(): SendMail
    {
        return $this->view('mail.send-mail');
    }
}
