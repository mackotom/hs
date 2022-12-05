<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class HoursRequest extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;

    private Collection $additional_hours;

    private int $numberHours = 0;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $additional_hours)
    {
        $this->user = $user;
        $this->additional_hours = $additional_hours;
        $this->numberHours = $additional_hours->sum('hours');


    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: $this->user->email,
            subject: trans_choice('mail.requestHours.subject', $this->numberHours),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.hours.request',
            with: [
                'username' => $this->user->name,
                'additional_hours' => $this->additional_hours,
                'numberHours' => $this->numberHours
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
