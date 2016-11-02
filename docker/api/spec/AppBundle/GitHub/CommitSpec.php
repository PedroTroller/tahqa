<?php

namespace spec\AppBundle\GitHub;

use AppBundle\GitHub\Commit;
use AppBundle\Model;
use AppBundle\Model\Provider;
use PhpSpec\ObjectBehavior;

class CommitSpec extends ObjectBehavior
{
    function let(Provider\Container $providers)
    {
        $data = json_decode($this->getJsonExample(), true);

        $this->beConstructedWith($data, $providers);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Commit::class);
    }

    function it_has_a_sha()
    {
        $this->getSha()->shouldReturn('ea6f4d473109c43253d4b5e75d473a51da819e08');
    }

    function it_has_an_url()
    {
        $this
            ->getUrl()
            ->shouldReturn('https://github.com/KnpLabs/Gaufrette/commit/ea6f4d473109c43253d4b5e75d473a51da819e08')
        ;
    }

    function it_has_a_message()
    {
        $this
            ->getMessage()
            ->shouldReturn("Merge pull request #413 from NiR-/fix/remove-unneeded-str-replace\n\nRemove useless str_replace")
        ;
    }

    function it_has_a_parent_commit(Provider\Commit $provider, Model\Commit $commit, $providers)
    {
        $providers
            ->offsetGet('commits')
            ->willReturn($provider)
        ;

        $provider
            ->get('aaeeb42c692783005b84e5f4832864575b852eeb')
            ->willReturn($commit)
        ;

        $this
            ->getParent()
            ->shouldReturn($commit)
        ;
    }

    function it_has_an_author(Provider\People $provider, Model\People $author, $providers)
    {
        $providers
            ->offsetGet('peoples')
            ->willReturn($provider)
        ;

        $provider
            ->get('akovalyov')
            ->willReturn($author)
        ;

        $this
            ->getAuthor()
            ->shouldReturn($author)
        ;
    }

    private function getJsonExample()
    {
        return file_get_contents(sprintf('%s/../../fixtures/commit.json', __DIR__));
    }
}
