<?php

namespace AppBundle\Model\Provider;

use AppBundle\Model\Provider;

interface Branch extends Provider
{
    /**
     * @return \AppBundle\Model\Branch[]
     */
    public function all();

    /**
     * @param string $name
     * @param bool   $lazy
     *
     * @return \AppBundle\Model\Branch
     */
    public function get($name, $lazy = true);
}
