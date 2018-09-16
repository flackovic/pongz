<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->path('src')
    ->notPath('var')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
;
