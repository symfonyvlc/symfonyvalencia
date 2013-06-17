<?php

namespace SfVlc\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{

    /**
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
