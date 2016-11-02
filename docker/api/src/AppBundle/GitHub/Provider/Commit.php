<?php

namespace AppBundle\GitHub\Provider;

use AppBundle\GitHub as Model;
use AppBundle\Model\Provider\Commit as Provider;
use AppBundle\Model\Provider\Container;
use AppBundle\Project;
use Github\Client as GitHub;

class Commit implements Provider
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var GitHub
     */
    private $github;

    /**
     * @var Container
     */
    private $providers;

    /**
     * @param Project   $project
     * @param GitHub    $github
     * @param Container $providers
     */
    public function __construct(Project $project, GitHub $github, Container $providers)
    {
        $this->project   = $project;
        $this->github    = $github;
        $this->providers = $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function get($sha, $lazy = true)
    {
        if (true === $lazy) {
            return new Model\Commit\Lazy($sha, $this->providers);
        }

        $data = $this
            ->github
            ->api('repo')
            ->commits()
            ->show($this->project->getOwner(), $this->project->getName(), $sha)
        ;

        return new Model\Commit($data, $this->providers);
    }
}
