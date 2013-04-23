<?php

namespace SfVlc\NewsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SfVlcNewsBundle extends Bundle
{

   public function getParent()
    {
        return 'BladeTesterLightNewsBundle';
    }
}
