<?php

namespace SfVlc\MainBundle\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use BladeTester\HandyTestsBundle\Model\FactoryInterface;
use SfVlc\MainBundle\Form\Model\Contact;

class ContactFactory implements FactoryInterface
{
    public function getName()
    {
        return 'Contact';
    }

    public function build(array $attributes)
    {
        $contact = new Contact();
        $this->setDefaultFields($contact, $attributes);
        return $contact;
    }

    public function create(array $attributes)
    {
        $contact = $this->build($attributes);
        return $contact;
    }

    private function setDefaultFields($contact, array $attributes)
    {
        static $count = 1;
        $name = isset($attributes['name']) ? $attributes['name'] : "name_$count";
        $email = isset($attributes['email']) ? $attributes['email'] : "email_$count@valid.is";
        $message = isset($attributes['message']) ? $attributes['message'] : 'message';
        $contact->name = $name;
        $contact->email = $email;
        $contact->message = $message;
        $count++;
    }
}