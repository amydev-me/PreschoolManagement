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

    public $pdf,$filename,$to;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf,$filename,$to)
    {
        $this->pdf=$pdf;
        $this->filename=$filename;
        $this->to=$to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@schoolapp.axiom.com.mm','Central Park')
            ->to($this->to)
            ->subject('Invoice From Central Park Preschool')
            ->attachData($this->pdf, $this->filename, ['mime' => 'application/pdf'])
            ->view('test');


    }
}