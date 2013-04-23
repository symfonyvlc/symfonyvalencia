<?php

namespace SfVlc\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BladeTester\LightNewsBundle\Entity\News as BaseNews;


/**
 * @ORM\Entity()
 * @ORM\Table(name="news")
 */
class News extends BaseNews {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    public function getId() {
        return $this->id;
    }
}