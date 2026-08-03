<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadReceived extends Mailable
{
    use Queueable, SerializesModels;

    public array $typeLabels = [
        'creator' => 'Pendaftaran Creator',
        'brand' => 'Kerjasama Brand',
        'consultation' => 'Konsultasi',
        'marketplace' => 'Ajak Kerjasama Kreator',
        'campaign' => 'Pengajuan Campaign',
    ];

    public function __construct(
        public Lead $lead,
        public ?Campaign $campaign = null,
    ) {}

    public function envelope(): Envelope
    {
        $label = $this->typeLabels[$this->lead->type] ?? 'Lead Baru';

        return new Envelope(
            subject: "[VOBI] {$label} — {$this->lead->name}",
            replyTo: $this->lead->email ? [$this->lead->email] : [],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.lead-received',
            with: [
                'lead' => $this->lead,
                'campaign' => $this->campaign,
                'typeLabel' => $this->typeLabels[$this->lead->type] ?? 'Lead Baru',
            ],
        );
    }
}
