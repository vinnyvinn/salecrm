<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailOnActionComplete extends Mailable
{
    use Queueable, SerializesModels;

    public $title;

    public $body;

    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$body,$name)
    {
        $this->title = $title;
        $this->body = $body;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)->view('emails.notify')->with(['title'=>$this->title,'body'=>$this->body,'name'=>$this->name]);
    }
}
