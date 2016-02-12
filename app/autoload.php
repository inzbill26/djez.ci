<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('WhiteOctober', realpath(__DIR__.'/../vendor/bundles'));
$loader->add('Pagerfanta', realpath(__DIR__.'/../vendor/pagerfanta/src'));
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
