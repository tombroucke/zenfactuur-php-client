<?php

namespace Otomaties\Zenfactuur\Invoices;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class SendByEmailRequest extends Request
{
    use AsJson;

    private ?string $cc = null;

    private ?string $bcc = null;

    private ?string $subject = null;

    private ?string $content = null;

    private ?int $attachPdf = null;

    private ?int $attachXml = null;

    private ?int $sendReminder = null;

    public function __construct(private int $invoiceId, private string $to)
    {
        //
    }

    public function method(): string
    {
        return 'POST';
    }

    public function endpoint(): string
    {
        return 'invoices/'.$this->invoiceId.'/send_by_email.json';
    }

    protected function defaultBody()
    {
        return array_filter([
            'to' => $this->to,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
            'subject' => $this->subject,
            'content' => $this->content,
            'attach_pdf' => $this->attachPdf,
            'attach_xml' => $this->attachXml,
            'send_reminder' => $this->sendReminder,
        ]);
    }

    public function cc(string $cc): self
    {
        $this->cc = $cc;

        return $this;
    }

    public function bcc(string $bcc): self
    {
        $this->bcc = $bcc;

        return $this;
    }

    public function subject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function content(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function attachPdf(bool $attachPdf = true): self
    {
        $this->attachPdf = $attachPdf ? 1 : 0;

        return $this;
    }

    public function attachXml(bool $attachXml = true): self
    {
        $this->attachXml = $attachXml ? 1 : 0;

        return $this;
    }

    public function sendReminder(bool $sendReminder = true): self
    {
        $this->sendReminder = $sendReminder ? 1 : 0;

        return $this;
    }
}
