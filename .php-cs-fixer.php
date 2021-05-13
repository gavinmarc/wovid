<?php

$finder = PhpCsFixer\Finder::create()
  ->notPath('vendor')
  ->notPath('bootstrap')
  ->notPath('storage')
  ->in(__DIR__)
  ->name('*.php')
  ->notName('*.blade.php');

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'no_unused_imports' => true,
  ])
  ->setIndent('  ')
  ->setFinder($finder);
