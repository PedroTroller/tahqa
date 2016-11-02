<?php

namespace AppBundle\Model\Provider;

use AppBundle\Model\Provider;

interface Release extends Provider
{
    /**
     * @return \AppBundle\Model\Release[]
     */
    public function all();

    /**
     * @param string $name
     * @param bool   $lazy
     *
     * @return \AppBundle\Model\Release
     */
    public function get($name, $lazy = true);
}
