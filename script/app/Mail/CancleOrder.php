<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancleOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $info;
    public $order_content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $info)
    {
        $this->info = $info;

      $this->order_content = json_decode($info->order_content->value);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('mohamedchi2013@gmail.com', $this->info, $this->order_content)                     
                    ->subject('Details of your order')
                    ->markdown('email.orders.placed');
    }
}
