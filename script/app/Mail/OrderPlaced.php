<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $info;
    public $order_content;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $info,$email)
    {
        $this->info = $info;
        $this->email = $email;

      $this->order_content = json_decode($info->order_content->value);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email, $this->info, $this->order_content)                     
                    ->subject('تفاصيل طلبك')
                    ->markdown('email.orders.placed');
    }
}
