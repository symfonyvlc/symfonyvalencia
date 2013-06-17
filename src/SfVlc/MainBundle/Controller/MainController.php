<?php

namespace SfVlc\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
}
