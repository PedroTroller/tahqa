<?php

namespace AppBundle\GitHub;

use AppBundle\Model;
use AppBundle\Model\Provider;

class Commit implements Model\Commit
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var Provider\Container
     */
    private $providers;

    /**
     * @param array           $data
     * @param Provider\Commit $provider
     */
    public function __construct(array $data, Provider\Container $providers)
    {
        $this->data      = $data;
        $this->providers = $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getSha()
    {
        return $this->data['sha'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->data['html_url'];
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->data['commit']['message'];
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        foreach ($this->data['parents'] as $parent) {
            return $this
                ->providers['commits']
                ->get($parent['sha'])
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        return $this
            ->providers['peoples']
            ->get($this->data['author']['login'])
        ;
    }
}
