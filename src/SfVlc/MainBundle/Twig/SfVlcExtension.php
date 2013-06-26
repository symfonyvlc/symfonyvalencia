<?php

namespace SfVlc\MainBundle\Twig;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class SfVlcExtension extends \Twig_Extension
{

    private $request;

    public function onKernelRequest(GetResponseEvent $event) {
        if ($event->getRequestType() === HttpKernel::MASTER_REQUEST) {
            $this->request = $event->getRequest();
        }
    }

    public function getFilters()
    {
        $filters = array();
        $filters['shuffle'] = new \Twig_Filter_Method($this, 'shuffle');
        return $filters;
    }


    public function shuffle(array $collection) {
        if ($collection instanceof Traversable) {
           $collection = iterator_to_array($collection, false);
        }
        shuffle($collection);
        return $collection;
    }

    public function getName()
    {
        return 'sfvlc extension';
    }
}

