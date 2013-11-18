<?php

namespace SfVlc\MainBundle\Mailer;

interface ContactConfigurationInterface
{
	public function getSubject();
	public function getTo();
}