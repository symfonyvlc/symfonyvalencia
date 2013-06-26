<?php

namespace SfVlc\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SfVlc\MainBundle\Form\Type\ContactType;
use SfVlc\MainBundle\Form\Model\Contact;

class MainController extends Controller
{

    /**
     * @Template()
     */
    public function indexAction()
    {
        $post_manager = $this->get('blade_tester_light_news.news_manager');
        $posts = $post_manager->findBy(array(), array('createdAt' => 'DESC'));
        return array(
            'posts' => $posts
            );
    }

    /**
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('Email de Symfony Valencia')
                    ->setFrom($contact->email)
                    ->setTo('symfony_vlc@gmail.com')
                    ->setBody($contact->name . ' ' . $contact->message)
                ;

                $mailer = $this->get('mailer');
                $mailer->send($message);

                $sessionBag = $request->getSession()->getFlashBag();
                $sessionBag->add('success', 'El mensaje se ha enviado correctamente');

                return $this->redirect($this->generateUrl('sf_vlc_main_contact'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

}
