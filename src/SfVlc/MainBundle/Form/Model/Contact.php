<?php

namespace SfVlc\MainBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @Assert\Email
     */
    public $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max = "350")
     */
    public $message;
}