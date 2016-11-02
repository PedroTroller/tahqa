<?php

namespace AppBundle\Model\Provider;

use AppBundle\Model\Provider;
use ArrayAccess;
use Exception;

class Container implements ArrayAccess
{
    /**
     * @var Provider[]
     */
    private $providers = [];

    /**
     * @param string   $resource
     * @param Provider $provider
     */
    public function addProvider($resource, Provider $provider)
    {
        $this->providers[$resource] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->providers);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->providers[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new Exception('The addProvider method must be used.');
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        throw new Exception('A provider can\'t be removed.');
    }
}
