<?php

namespace spec\AppBundle\GitHub\Commit;

use AppBundle\GitHub\Commit;
use AppBundle\Model\People;
use AppBundle\Model\Provider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LazySpec extends ObjectBehavior
{
    function let(Provider\Container $providers, Provider\Commit $provider)
    {
        $providers->offsetGet('commits')->willReturn($provider);

        $this->beConstructedWith('foo', $providers);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Commit\Lazy::class);
    }

    function it_has_a_sha_but_without_loading_the_real_commit($provider)
    {
        $provider->get(Argument::cetera())->shouldNotbeCalled();

        $this->getSha()->shouldReturn('foo');
    }

    function it_has_an_url_from_the_real_commit_just_once($provider, Commit $commit)
    {
        $provider->get('foo', false)->willReturn($commit)->shouldBeCalledTimes(1);
        $commit->getUrl()->willReturn('foo@bar.baz');

        $this
            ->getUrl()
            ->shouldReturn('foo@bar.baz')
        ;

        $this
            ->getUrl()
            ->shouldReturn('foo@bar.baz')
        ;
    }

    function it_has_a_message_from_the_real_commit_juste_once($provider, Commit $commit)
    {
        $provider->get('foo', false)->willReturn($commit)->shouldBeCalledTimes(1);
        $commit->getMessage()->willReturn('the foo');

        $this
            ->getMessage()
            ->shouldReturn('the foo')
        ;

        $this
            ->getMessage()
            ->shouldReturn('the foo')
        ;
    }

    function it_has_a_parent_commit_from_the_real_commit_juste_once($provider, Commit $commit, Commit $parent)
    {
        $provider->get('foo', false)->willReturn($commit)->shouldBeCalledTimes(1);
        $commit->getParent()->willReturn($parent);

        $this
            ->getParent()
            ->shouldReturn($parent)
        ;

        $this
            ->getParent()
            ->shouldReturn($parent)
        ;
    }

    function it_has_an_author_from_the_real_commit_juste_once($provider, Commit $commit, People $author)
    {
        $provider->get('foo', false)->willReturn($commit)->shouldBeCalledTimes(1);
        $commit->getAuthor()->willReturn($author);

        $this
            ->getAuthor()
            ->shouldReturn($author)
        ;

        $this
            ->getAuthor()
            ->shouldReturn($author)
        ;
    }
}
