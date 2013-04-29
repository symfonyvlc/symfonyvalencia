<?php

namespace SfVlc\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SfVlcUserBundle extends Bundle
{

   public function getParent()
    {
        return 'FOSUserBundle';
    }
}
