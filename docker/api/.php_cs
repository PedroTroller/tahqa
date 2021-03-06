<?php

return Symfony\CS\Config\Config::create()
    ->fixers(array(
        'align_double_arrow',
        'align_equals',
        'assign_and_return',
        'concat_with_spaces',
        'line_break_between_statements',
        'mbstring',
        'no_empty_comment',
        'no_useless_return',
        'ordered_use',
        'php_unit_construct',
        'php_unit_strict',
        'phpdoc_order',
        'phpspec',
        'short_array_syntax',
        'strict_param',
    ))
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\AssignAndReturnFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\LineBreakBetweenStatementsFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\MbstringFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\PhpspecFixer())
    ->finder(Symfony\CS\Finder\DefaultFinder::create()
        ->in('app')
        ->in('spec')
        ->in('src')
        ->in('web')
    )
;
