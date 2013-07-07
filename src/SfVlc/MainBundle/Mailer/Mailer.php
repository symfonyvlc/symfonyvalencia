<?php

namespace SfVlc\MainBundle\Mailer;

use SfVlc\MainBundle\Form\Model\Contact;
use SfVlc\MainBundle\Mailer\ContactConfigurationInterface;

class Mailer
{
	protected $mailer;
	protected $settings;

	function __construct($mailer, ContactConfigurationInterface $settings)
	{
		$this->mailer = $mailer;
		$this->settings = $settings;
	}

	public function sendContactEmail(Contact $contact)
	{
		$message = \Swift_Message::newInstance()
            ->setSubject($this->settings->getSubject())
            ->setFrom($contact->email)
            ->setTo($this->settings->getTo())
            ->setBody($contact->name . ' ' . $contact->message)
        ;

        $this->mailer->send($message);
	}
}