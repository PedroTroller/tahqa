<?php

namespace AppBundle\Model\Provider;

use AppBundle\Model\Provider;

interface People extends Provider
{
    /**
     * @return \AppBundle\Model\People[]
     */
    public function all();

    /**
     * @param string $login
     * @param bool   $lazy
     *
     * @return \AppBundle\Model\People
     */
    public function get($login, $lazy = true);
}
