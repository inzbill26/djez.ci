<?php

namespace Djez\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DjezUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
