<?php

namespace SfVlc\MainBundle\Tests\Controller;

use SfVlc\MainBundle\Form\Model\Contact;
use SfVlc\MainBundle\Mailer\Mailer;

class MailerTest extends BaseControllerTest {

    /**
     * @test 
     * @group mailer
     */
    public function iShoulInvokeSendMethod()
    {
        // Arrange
        $mailerMock = $mailer = $this
            ->getMockBuilder('\Swift_Mailer')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $contactMock = $this->getMock('Contact');
        $contactConfiguration = $this->getService('sf_vlc_main.contact_configuration');
        $mailer = new Mailer($mailerMock, $contactConfiguration);
 
        $contact = $this->create('Contact');
        
        // Expect
        $mailerMock->expects($this->once())->method('send');
 
        // Act
        $mailer->sendContactEmail($contact);
    }
}
