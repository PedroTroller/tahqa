<?php

namespace AppBundle\Model\Provider;

use AppBundle\Model\Provider;

interface Commit extends Provider
{
    /**
     * @return \AppBundle\Model\Commit[]
     */
    public function all();

    /**
     * @param string $sha
     * @param bool   $lazy
     *
     * @return \AppBundle\Model\Commit
     */
    public function get($sha, $lazy = true);
}
