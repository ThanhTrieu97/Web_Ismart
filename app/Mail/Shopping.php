<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Shopping extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    // public $shopping;
    public function __construct($data)
    {
        //
        $this->data = $data;
        // $this->shopping = $shopping;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('cart.email')
                    ->with($this->data);
                    // ->with([
                    //     'data' => $this->data,
                    //     'shopping' => $this->shopping,
                    // ]);
    }
}
