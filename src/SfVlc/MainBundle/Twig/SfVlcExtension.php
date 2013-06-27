<?php

namespace SfVlc\MainBundle\Twig;

class SfVlcExtension extends \Twig_Extension
{

    public function getFilters()
    {
        $filters = array();
        $filters['shuffle'] = new \Twig_Filter_Method($this, 'shuffle');
        return $filters;
    }


    public function shuffle($collection) {
        if ($collection instanceof Traversable) {
           $collection = iterator_to_array($collection, false);
        }
        shuffle($collection);
        return $collection;
    }

    public function getName()
    {
        return 'sfvlc_extension';
    }
}

