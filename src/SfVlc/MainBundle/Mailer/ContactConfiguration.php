<?php

namespace SfVlc\MainBundle\Mailer;

/**
* 
*/
class ContactConfiguration implements ContactConfigurationInterface
{
	private $settings;
	
	function __construct($settings)
	{
		$this->settings = $settings;
	}

	public function getSubject()
	{
		return isset($settings['subject']) ? $settings['subject'] : null;
	}
	public function getTo()
	{
		return isset($settings['to']) ? $settings['to'] : null;
	}
}