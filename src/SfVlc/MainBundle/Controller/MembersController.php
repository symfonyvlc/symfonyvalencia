<?php

namespace SfVlc\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MembersController extends Controller
{

    /**
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $members = $em->getRepository('SfVlcUserBundle:User')->findAllByRole('ROLE_MEMBER');
        return array(
            'members' => $members
        );
    }
}