<?php

namespace spec\AppBundle\DependencyInjection;

use AppBundle\DependencyInjection\ParamsCompiler;
use PhpSpec\ObjectBehavior;

class ParamsCompilerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ParamsCompiler::class);
    }

    function it_compiles_configuration()
    {
        $configs = [
            'jwt' => [
                'key'        => 'the_key',
                'algorithms' => ['HS256'],
            ],
        ];

        expect(ParamsCompiler::compile($configs, 'api'))->toBe([
            'api.jwt'              => ['key' => 'the_key', 'algorithms' => ['HS256']],
            'api.jwt.key'          => 'the_key',
            'api.jwt.algorithms'   => ['HS256'],
            'api.jwt.algorithms.0' => 'HS256',
        ]);
    }
}
