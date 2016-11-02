<?php

namespace spec\AppBundle\GitHub\Provider;

use AppBundle\GitHub as Model;
use AppBundle\GitHub\Provider\Commit;
use AppBundle\Model\Provider\Container;
use AppBundle\Project;
use Github\Api\Repo as RepoApi;
use Github\Api\Repository\Commits as CommitApi;
use Github\Client as GitHub;
use PhpSpec\ObjectBehavior;

class CommitSpec extends ObjectBehavior
{
    function let(Project $project, GitHub $github, Container $providers, RepoApi $repo, CommitApi $commits)
    {
        $github->api('repo')->willReturn($repo);
        $repo->commits()->willReturn($commits);

        $this->beConstructedWith($project, $github, $providers);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Commit::class);
    }

    public function it_loads_all_()
    {

    }

    function it_lazy_loads_a_commit()
    {
        $commit = $this->get('foo', true);
        $commit->shouldHaveType(Model\Commit\Lazy::class);
    }

    function it_returns_a_real_commit($project, $commits)
    {
        $project->getOwner()->willReturn('knp');
        $project->getName()->willReturn('project');
        $commits->show('knp', 'project', 'foo')->willReturn([]);

        $commit = $this->get('foo', false);
        $commit->shouldHaveType(Model\Commit::class);
    }
}
