<?php

namespace App\Mail;

use App\Helpers\FeedbackFileHelper;
use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientFeedback extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(FeedbackFileHelper $fileHelper)
    {
        if (!$this->feedback->file)
            return $this->from(config('feedback.feedback_email'), 'Feedback from client')
                ->view('emails.feedback');

        return $this->from(config('feedback.feedback_email'), 'Feedback from client')
            ->view('emails.feedback')
            ->with([
                'urlToFile' => $fileHelper->getFileUrl($this->feedback)
            ])
            ->attachFromStorage($fileHelper->getFilePathToAttach($this->feedback));
    }
}
