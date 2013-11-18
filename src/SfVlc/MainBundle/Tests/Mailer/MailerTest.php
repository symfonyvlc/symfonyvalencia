<?php

namespace SfVlc\MainBundle\Tests\Controller;

use SfVlc\MainBundle\Mailer\Mailer;

class MailerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test 
     * @group mailer
     */
    public function itSendsEmails()
    {
        // Arrange
        $mailerMock = $this
            ->getMockBuilder('\Swift_Mailer')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $contact = $this->getMock('SfVlc\MainBundle\Form\Model\Contact');
        $contactConfiguration = $this
            ->getMockBuilder('SfVlc\MainBundle\Mailer\ContactConfiguration')
            ->disableOriginalConstructor()
            ->getMock();
        $mailer = new Mailer($mailerMock, $contactConfiguration);
        
        // Expect
        $mailerMock->expects($this->once())->method('send');

        // Act
        $mailer->sendContactEmail($contact);
    }
}
