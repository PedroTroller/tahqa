<?php

namespace AppBundle\GitHub\Commit;

use AppBundle\Model\Commit;
use AppBundle\Model\Provider;

class Lazy implements Commit
{
    /**
     * @var string
     */
    private $sha;

    /**
     * @var Provider\Container
     */
    private $providers;

    /**
     * @var Commit
     */
    private $wrapped;

    /**
     * @param string             $sha
     * @param Provider\Container $providers
     */
    public function __construct($sha, Provider\Container $providers)
    {
        $this->sha       = $sha;
        $this->providers = $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->wrap()->getUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->wrap()->getMessage();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->wrap()->getParent();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        return $this->wrap()->getAuthor();
    }

    /**
     * @return Commit
     */
    private function wrap()
    {
        if (null === $this->wrapped) {
            $this->wrapped = $this->providers['commits']->get($this->sha, false);
        }

        return $this->wrapped;
    }
}
