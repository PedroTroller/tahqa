<?php

namespace AppBundle\Model;

interface Provider
{
    /**
     * @return object[]
     */
    public function all();

    /**
     * @param string $name
     * @param bool   $lazy
     *
     * @return object
     */
    public function get($name, $lazy = true);
}
