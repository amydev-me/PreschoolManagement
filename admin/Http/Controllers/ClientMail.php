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

    private $info,$file,$tomails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info,$file,$tomails)
    {
        $this->info=$info;
        $this->file=$file;
        $this->tomails=$tomails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Invoice';
        $title = '';
        if ($this->info->subject) {
            $subject = $this->info->subject;
        }
        if ($this->info->title) {
            $title = $this->info->title;
        }
        return $this
            ->from($this->info->email, $title)
            ->subject( $subject)
            ->to($this->tomails)
            ->attach($this->file)
            ->view('test', ['info' => $this->info]);
    }
}