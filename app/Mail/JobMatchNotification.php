<?php

namespace App\Mail;

use App\Models\JobList;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobMatchNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     public $job;
    public $candidate;

    public function __construct(User $candidate, JobList $job)
    {
        $this->candidate = $candidate;
        $this->job = $job;
    }

    public function build()
    {
        return $this->subject("Job Match Found: {$this->job->title}")
                    ->view('emails.job_match');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
