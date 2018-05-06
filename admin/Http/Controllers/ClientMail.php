<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/05/2018
 * Time: 10:12 AM
 */

namespace Admin\Http\Controllers;


use Data\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@schoolapp.axiom.com.mm','Central Park Preschool')->view('test');
    }
}