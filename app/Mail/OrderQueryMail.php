<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderQueryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    public $customerEmail;

    public function __construct($products, $customerEmail)
    {
        $this->products = $products;
        $this->customerEmail = $customerEmail;
    }

    public function build()
    {
        return $this->subject('New Order Query')
                    ->view('emails.order-query');
    }
}
